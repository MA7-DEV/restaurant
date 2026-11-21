<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    private function createMeal(bool $available = true): Meal
    {
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'Test category',
        ]);

        return Meal::create([
            'name' => 'Test Meal',
            'description' => 'Test description',
            'price' => 12.50,
            'category_id' => $category->id,
            'image' => null,
            'is_available' => $available,
        ]);
    }

    private function checkoutData(): array
    {
        return [
            'address' => 'Test Address',
            'phone' => '01012345678',
        ];
    }

    public function test_customer_can_place_a_valid_order(): void
    {
        $user = User::factory()->create();
        $meal = $this->createMeal();

        $response = $this->actingAs($user)
            ->withSession([
                'cart' => [
                    $meal->id => [
                        'id' => $meal->id,
                        'quantity' => 2,
                        'price' => 1,
                    ],
                ],
            ])
            ->post(route('checkout.store'), $this->checkoutData());

        $response->assertRedirect(route('customer.dashboard'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $order = Order::where('user_id', $user->id)->firstOrFail();

        $this->assertEquals(25.00, (float) $order->total_price);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'meal_id' => $meal->id,
            'quantity' => 2,
            'price' => 12.50,
        ]);

        $response->assertSessionMissing('cart');
    }

    public function test_unavailable_meal_cannot_be_ordered(): void
    {
        $user = User::factory()->create();
        $meal = $this->createMeal(false);

        $response = $this->actingAs($user)
            ->withSession([
                'cart' => [
                    $meal->id => [
                        'id' => $meal->id,
                        'quantity' => 1,
                    ],
                ],
            ])
            ->from(route('checkout.index'))
            ->post(route('checkout.store'), $this->checkoutData());

        $response->assertRedirect(route('checkout.index'));
        $response->assertSessionHasErrors('cart');

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);

        $response->assertSessionHas('cart');
    }

    public function test_invalid_quantity_cannot_be_ordered(): void
    {
        $user = User::factory()->create();
        $meal = $this->createMeal();

        $response = $this->actingAs($user)
            ->withSession([
                'cart' => [
                    $meal->id => [
                        'id' => $meal->id,
                        'quantity' => 0,
                    ],
                ],
            ])
            ->from(route('checkout.index'))
            ->post(route('checkout.store'), $this->checkoutData());

        $response->assertRedirect(route('checkout.index'));
        $response->assertSessionHasErrors('cart');

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);

        $response->assertSessionHas('cart');
    }
}

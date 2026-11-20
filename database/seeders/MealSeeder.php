<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Support\Str;

class MealSeeder extends Seeder
{
    public function run(): void
    {
        // 1. نتأكد إن الأقسام موجودة (لو مش موجودة ننشئها)
        $categoriesData = [
            'Starters' => 'Appetizers and small plates',
            'Main Course' => 'Our signature main dishes',
            'Seafood' => 'Fresh from the ocean',
            'Desserts' => 'Sweet endings',
            'Beverages' => 'Refreshing drinks'
        ];

        foreach ($categoriesData as $name => $desc) {
            Category::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name), 'description' => $desc]
            );
        }

        // 2. نجيب الأقسام
        $starter = Category::where('name', 'Starters')->first();
        $main = Category::where('name', 'Main Course')->first();
        $seafood = Category::where('name', 'Seafood')->first();
        $dessert = Category::where('name', 'Desserts')->first();
        $beverage = Category::where('name', 'Beverages')->first();

        // 3. قائمة الوجبات (أكثر من 40 وجبة)
        $meals = [
            // ===== Starters (8) =====
            ['name' => 'Truffle Arancini', 'desc' => 'Crispy risotto balls stuffed with truffle and mozzarella.', 'price' => 12.99, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1541529086526-db283c563270?w=600'],
            ['name' => 'Garlic Butter Shrimp', 'desc' => 'Sautéed shrimp in a rich garlic butter sauce.', 'price' => 15.50, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1625938145744-e380515232ad?w=600'],
            ['name' => 'Crispy Calamari', 'desc' => 'Lightly fried squid rings with marinara sauce.', 'price' => 11.00, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=600'],
            ['name' => 'Bruschetta', 'desc' => 'Toasted bread topped with tomatoes, basil, and olive oil.', 'price' => 8.50, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1572695157366-5e585ab2b69f?w=600'],
            ['name' => 'Stuffed Mushrooms', 'desc' => 'Mushrooms filled with cream cheese and herbs.', 'price' => 10.00, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1504544750208-dc0358e63f7f?w=600'],
            ['name' => 'Caprese Salad', 'desc' => 'Fresh mozzarella, tomatoes, and basil.', 'price' => 9.00, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1592417817098-8fd3d9eb14a5?w=600'],
            ['name' => 'Spring Rolls', 'desc' => 'Crispy vegetable spring rolls with sweet chili sauce.', 'price' => 7.50, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600'],
            ['name' => 'Chicken Wings', 'desc' => 'Spicy buffalo wings with blue cheese dip.', 'price' => 13.00, 'cat' => $starter->id, 'img' => 'https://images.unsplash.com/photo-1567620832903-9fc6debc209f?w=600'],

            // ===== Main Course (10) =====
            ['name' => 'Wagyu Beef Steak', 'desc' => 'Premium Wagyu steak served with truffle mashed potatoes.', 'price' => 85.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600'],
            ['name' => 'Herb Roasted Chicken', 'desc' => 'Half chicken roasted with rosemary and lemon.', 'price' => 28.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=600'],
            ['name' => 'Truffle Tagliatelle', 'desc' => 'Fresh pasta with black truffle cream sauce.', 'price' => 32.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1551183053-bf91a1d81141?w=600'],
            ['name' => 'Beef Wellington', 'desc' => 'Tender beef fillet wrapped in puff pastry.', 'price' => 55.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=600'],
            ['name' => 'Lamb Chops', 'desc' => 'Grilled lamb chops with mint sauce.', 'price' => 45.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1514516345957-556ca7d90a29?w=600'],
            ['name' => 'Chicken Parmesan', 'desc' => 'Breaded chicken topped with marinara and mozzarella.', 'price' => 26.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1632778149955-e80f8ceca2e8?w=600'],
            ['name' => 'Mushroom Risotto', 'desc' => 'Creamy arborio rice with wild mushrooms.', 'price' => 24.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1476124369491-e7addf5db371?w=600'],
            ['name' => 'BBQ Ribs', 'desc' => 'Slow-cooked pork ribs with smoky BBQ sauce.', 'price' => 38.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600'],
            ['name' => 'Vegetable Lasagna', 'desc' => 'Layers of pasta, vegetables, and cheese.', 'price' => 22.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1574894709920-11b28e7367e3?w=600'],
            ['name' => 'Beef Burger', 'desc' => 'Juicy beef patty with cheese and fries.', 'price' => 18.00, 'cat' => $main->id, 'img' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600'],

            // ===== Seafood (8) =====
            ['name' => 'Grilled Salmon', 'desc' => 'Atlantic salmon with asparagus and hollandaise.', 'price' => 34.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600'],
            ['name' => 'Lobster Thermidor', 'desc' => 'Classic lobster dish with creamy brandy sauce.', 'price' => 65.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1553247407-23251ce81f59?w=600'],
            ['name' => 'Seared Scallops', 'desc' => 'Pan-seared scallops with pea purée.', 'price' => 29.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1599084993091-1cb5c0721cc6?w=600'],
            ['name' => 'Fish and Chips', 'desc' => 'Beer-battered cod with crispy fries.', 'price' => 22.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1579208570378-8c970854bc23?w=600'],
            ['name' => 'Shrimp Scampi', 'desc' => 'Shrimp sautéed in garlic and white wine sauce.', 'price' => 28.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1625938145744-e380515232ad?w=600'],
            ['name' => 'Crab Cakes', 'desc' => 'Pan-fried crab cakes with remoulade sauce.', 'price' => 32.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1559737558-2f5a35f4523b?w=600'],
            ['name' => 'Tuna Tartare', 'desc' => 'Fresh tuna with avocado and citrus dressing.', 'price' => 26.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=600'],
            ['name' => 'Garlic Prawns', 'desc' => 'King prawns in a rich garlic sauce.', 'price' => 35.00, 'cat' => $seafood->id, 'img' => 'https://images.unsplash.com/photo-1625943553852-781c6dd46faa?w=600'],

            // ===== Desserts (8) =====
            ['name' => 'Gold Leaf Soufflé', 'desc' => 'Fluffy chocolate soufflé topped with edible gold.', 'price' => 18.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=600'],
            ['name' => 'Classic Tiramisu', 'desc' => 'Coffee-soaked ladyfingers with mascarpone cream.', 'price' => 14.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=600'],
            ['name' => 'Cheesecake', 'desc' => 'New York style cheesecake with berry coulis.', 'price' => 12.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=600'],
            ['name' => 'Crème Brûlée', 'desc' => 'Rich custard base topped with hardened caramelized sugar.', 'price' => 15.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1470324161839-ce2bb6fa6bc3?w=600'],
            ['name' => 'Chocolate Lava Cake', 'desc' => 'Warm chocolate cake with a molten center.', 'price' => 16.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=600'],
            ['name' => 'Apple Pie', 'desc' => 'Classic apple pie with cinnamon and ice cream.', 'price' => 11.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1568571780765-9276ac8b75a2?w=600'],
            ['name' => 'Panna Cotta', 'desc' => 'Italian cream dessert with berry sauce.', 'price' => 13.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=600'],
            ['name' => 'Macarons', 'desc' => 'Assorted French macarons.', 'price' => 10.00, 'cat' => $dessert->id, 'img' => 'https://images.unsplash.com/photo-1569864358642-9d1684040f43?w=600'],

            // ===== Beverages (6) =====
            ['name' => 'Signature Cocktail', 'desc' => 'Our secret blend of premium spirits.', 'price' => 16.00, 'cat' => $beverage->id, 'img' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=600'],
            ['name' => 'Fresh Lemonade', 'desc' => 'Freshly squeezed lemons with mint.', 'price' => 6.00, 'cat' => $beverage->id, 'img' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=600'],
            ['name' => 'Espresso Martini', 'desc' => 'Vodka, coffee liqueur, and fresh espresso.', 'price' => 18.00, 'cat' => $beverage->id, 'img' => 'https://images.unsplash.com/photo-1545438102-799c3991ffb2?w=600'],
            ['name' => 'Mojito', 'desc' => 'White rum, mint, lime, and soda.', 'price' => 14.00, 'cat' => $beverage->id, 'img' => 'https://images.unsplash.com/photo-1551538827-9c037cb4f32a?w=600'],
            ['name' => 'Iced Coffee', 'desc' => 'Cold brew coffee with milk.', 'price' => 5.00, 'cat' => $beverage->id, 'img' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600'],
            ['name' => 'Smoothie', 'desc' => 'Mixed berry smoothie with yogurt.', 'price' => 8.00, 'cat' => $beverage->id, 'img' => 'https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=600'],
        ];

        // 4. حفظ الوجبات
        foreach ($meals as $meal) {
            Meal::firstOrCreate(
                ['name' => $meal['name']],
                [
                    'description' => $meal['desc'],
                    'price' => $meal['price'],
                    'category_id' => $meal['cat'],
                    'image' => $meal['img'],
                    'is_available' => true,
                ]
            );
        }
    }
}
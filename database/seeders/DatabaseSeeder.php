<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء حساب الأدمن
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@restaurant.com',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        // 2. إنشاء حساب عميل للتجربة
        User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
        ]);
    }
}
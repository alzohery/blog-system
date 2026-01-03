<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Admin\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name'       => 'Super Admin',
                'password'   => Hash::make('password123'),
                'is_active'  => true,
            ]
        );
    }
}

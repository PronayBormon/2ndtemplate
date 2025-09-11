<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['super_admin', 'admin', 'manager', 'editor', 'user'];

        foreach ($roles as $role) {
            User::create([
                'name' => ucfirst($role) . ' User',
                'email' => $role . '@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => $role,
                'status' => 'active',
            ]);
        }
    }
}

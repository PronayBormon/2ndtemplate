<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['super_admin', 'admin', 'manager', 'editor', 'user'];

        foreach ($roles as $role) {
            User::firstOrCreate(
                ['email' => $role . '@gmail.com'], // check by email
                [
                    'name' => ucfirst($role) . ' User',
                    'password' => Hash::make('12345678'),
                    'role' => $role,
                    'status' => 'active', // adjust if your status column has specific values
                ]
            );
        }
    }
}

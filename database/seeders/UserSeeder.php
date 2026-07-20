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
        User::created([
            'name' => 'Admin',
            'email' => 'rakib@advancebd.com',
            'password' => Hash::make('12345678'),
            'type' => 'admin'
        ]);
        User::created([
            'name' => 'Manager',
            'email' => 'shohag@advancebd.com',
            'password' => Hash::make('12345678'),
            'type' => 'manager'
        ]);
        User::created([
            'name' => 'User',
            'email' => 'babu@advancebd.com',
            'password' => Hash::make('12345678'),
            'type' => 'user'
        ]);

    }
}
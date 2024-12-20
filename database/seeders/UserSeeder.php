<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'staf@gmail.com',
            'password' => Hash::make('staff'),
            'role' => 'STAFF',
        ]);
        User::create([
            'email' => 'guest@gmail.com',
            'password' => Hash::make('guest'),
            'role' => 'GUEST',
        ]);
        User::create([
            'email' => 'headstaf@gmail.com',
            'password' => Hash::make('headstaf'),
            'role' => 'HEAD_STAF',
        ]);
    }
}

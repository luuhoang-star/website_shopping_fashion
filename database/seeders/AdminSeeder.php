<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'test@gmail.com',
            'password' => Hash::make('1234'), // Mã hóa mật khẩu
            'is_admin' => 1,
        ]);
    }
}

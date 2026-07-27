<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserType;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
            'user_type'=>UserType::Admin->value,
        ]);
         User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('123456789'),
            'user_type'=>UserType::User->value,
        ]);
    }
}

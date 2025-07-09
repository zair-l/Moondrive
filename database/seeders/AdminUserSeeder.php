<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Luna',
            'lastname' => 'Admin',
            'residence' => 'AdminCity',
            'birthdate' => '2000-01-01',
            'phone' => '123456789',
            'email' => 'Luna@administrador.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

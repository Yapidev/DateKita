<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Yafy Habibi Riza Putra',
            'email' => 'yafy@gmail.com',
            'password' => bcrypt('password'),
            'gender' => 'male'
        ]);

        User::factory()->create([
            'name' => 'Febriana Dwi Anggraini',
            'email' => 'ria@gmail.com',
            'password' => bcrypt('password'),
            'gender' => 'female'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            [
                'email' => 'admin@nusstory.com',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@nusstory.com',
                'password' => bcrypt('admin@nusstory.com'),
                'google_id' => null,
                'role' => 'admin',
            ],
        );

        User::firstOrCreate(
            [
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin@gmail.com'),
                'google_id' => null,
                'role' => 'admin',
            ],
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $profilePath = storage_path('app/public/profile_users');

        $user = [
            ['name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'level' => '1',
            'profile' => 'images.jfif',
            'desc' => 'Admin',],
            ['name' => 'Tenant',
            'email' => 'tenant@gmail.com',
            'password' => bcrypt('123'),
            'level' => '2',
            'profile' => 'images.jfif',
            'desc' => 'Tenant',],
        ];

        DB::table('users')->insert($user);
    }
}

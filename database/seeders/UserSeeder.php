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
        $user = [
            ['name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'level' => '1',],
            ['name' => 'Tenant',
            'email' => 'tenant@gmail.com',
            'password' => bcrypt('123'),
            'level' => '2',],
        ];
        DB::table('users')->insert($user);
    }
}

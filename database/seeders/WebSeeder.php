<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $web = [
            ['name' => 'judulheader',
            'description' => 'Njenggrik',],
            ['name' => 'judulutama',
            'description' => 'ENJOY YOUR HEALTHY DELICIOUS FOOD',],
            ['name' => 'judulalamat',
            'description' => 'Address',],
            ['name' => 'alamat',
            'description' => 'Jl. Cianjur No.5, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113',],
            ['name' => 'alamatgoogle',
            'description' => 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d246.96202430467528!2d112.62048061612363!3d-7.958339216709954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1stmp!5e0!3m2!1sen!2sid!4v1687252827765!5m2!1sen!2sid',],
            ['name' => 'juduljamoperasional',
            'description' => 'Opening Hours',],
            ['name' => 'jamoperasional',
            'description' => 'Every Day 4PM - 1AM',],
            ['name' => 'judulemail',
            'description' => 'Email us',],
            ['name' => 'email',
            'description' => 'njcoffee@gmail.com',],
            ['name' => 'judulkontak',
            'description' => 'Call us',],
            ['name' => 'kontak',
            'description' => '08123456789',],
        ];

        DB::table('webs')->insert($web);
    }
}

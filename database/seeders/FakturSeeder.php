<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faktur = [
            'kode' => 'Faktur',
            'keterangan' => '0',
        ];

        DB::table('fakturs')->insert($faktur);

        $faktur = [
            'kode' => 'FakturTmp',
            'keterangan' => '0',
        ];
        DB::table('fakturs')->insert($faktur);
    }
}

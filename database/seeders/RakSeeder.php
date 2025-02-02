<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'kode_rak' => 'RAK' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'rak' => 'Rak ' . $i,
                'keterangan' => 'Keterangan rak ' . $i,
            ];
        }
        DB::table('tbl_rak')->insert($data);
    }
}

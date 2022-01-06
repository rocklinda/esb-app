<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'name' => 'Discovery Designs',
            'address' => '41 St Vincent Place Glasgow G1 2ER Scottland',
        ]);
        
        DB::table('suppliers')->insert([
            'name' => 'Toko Besi Suleman',
            'address' => 'Jalan Suka Damai No. 41 Jogjakarta Indonesia',
        ]);

        DB::table('suppliers')->insert([
            'name' => 'Die Kuche',
            'address' => '41 St Frankreich Frankfur Deustchland',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Barrington Publisher',
            'address' => '17 Great Suffolk Street London SE1 ONS United Kingdom',
        ]);

        DB::table('customers')->insert([
            'name' => 'Pusat Lemari Kayu',
            'address' => 'Jalan Sesama No.17 Aceh Indonesia',
        ]);

        DB::table('customers')->insert([
            'name' => 'Wasser und Brot',
            'address' => '17 Blackforest Achen Deustchland',
        ]);
    }
}

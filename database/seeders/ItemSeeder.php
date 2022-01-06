<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('items')->insert(
            [
            'supplier_id' => 1,
            'item_type' => 'Service',
            'description' => 'Design',
            'unit_price' => 230,
        ]);
        
        DB::table('items')->insert([
            'supplier_id' => 1,
            'item_type' => 'Service',
            'description' => 'Development',
            'unit_price' => 330,
        ]);

        DB::table('items')->insert([
            'supplier_id' => 1,
            'item_type' => 'Service',
            'description' => 'Meetings',
            'unit_price' => 60,
        ]);

        DB::table('items')->insert([
            'supplier_id' => 2,
            'item_type' => 'Raw Material',
            'description' => 'Besi',
            'unit_price' => 1000,
        ]);
        
        DB::table('items')->insert([
            'supplier_id' => 2,
            'item_type' => 'Raw Material',
            'description' => 'Kayu',
            'unit_price' => 550,
        ]);

        DB::table('items')->insert([
            'supplier_id' => 2,
            'item_type' => 'Raw Material',
            'description' => 'Terpal',
            'unit_price' => 50,
        ]);

        DB::table('items')->insert([
            'supplier_id' => 3,
            'item_type' => 'Finishing Goods',
            'description' => 'Baking Soda',
            'unit_price' => 20,
        ]);
        
        DB::table('items')->insert([
            'supplier_id' => 3,
            'item_type' => 'Finishing Goods',
            'description' => 'Fondant',
            'unit_price' => 150,
        ]);

        DB::table('items')->insert([
            'supplier_id' => 3,
            'item_type' => 'Finishing Goods',
            'description' => 'Whipped Creal',
            'unit_price' => 70,
        ]);
    }
}

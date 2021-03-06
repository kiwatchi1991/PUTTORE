<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('category_product')->insert([

        'product_id' => '2',
        'category_id' => '2',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
        [
        'product_id' => '2',
        'category_id' => '3',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ]
    );
    }
}

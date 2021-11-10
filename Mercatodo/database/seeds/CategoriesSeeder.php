<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Maderos', 'Trucks', 'Tablas Completas'];
        foreach($categories as $category){
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
       
    }
}

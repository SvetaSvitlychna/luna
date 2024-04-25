<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoriesTableSeeder extends Seeder
{
    public $categories = [
        ['name'=>'artisan',
        'description'=>'Artisan category',
        'status'=>true,],
        ['name'=>'php',
        'description'=>'php category',
        'status'=>false,],
        ['name'=>'laravel',
        'description'=>'laravel category',
        'status'=>true,]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {DB::statement('TRUNCATE TABLE categories');

     foreach($this->categories as $key =>$value){
        DB::insert(
        "INSERT INTO categories (name,description, status) VALUES (?,?,?)", [$value['name'],$value['description'], $value['status']]);
     }
    }
}

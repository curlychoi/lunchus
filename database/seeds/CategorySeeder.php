<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrcreate(['name' => '한식']);
        Category::firstOrcreate(['name' => '중식']);
        Category::firstOrcreate(['name' => '일식']);
        Category::firstOrcreate(['name' => '분식']);
        Category::firstOrcreate(['name' => '퓨전']);
        Category::firstOrcreate(['name' => '패스트푸드']);
    }
}

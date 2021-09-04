<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesDefaultSeeder extends Seeder
{
    private $categories = ['Linguagens','Frameworks','Idiomas'];

    public function run()
    {
        foreach ($this->categories as $category) {
            Category::updateOrCreate([
                'name' => $category
            ],[
                'name' => $category
            ]);
        }
    }
}
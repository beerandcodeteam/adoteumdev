<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesDefaultSeeder extends Seeder
{
    private array $categories = ['Linguagens','Frameworks','Idiomas'];

    public function run(): void
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
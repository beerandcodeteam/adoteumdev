<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesDefaultSeeder::class);
        $this->call(SkillsDefaultSeeder::class);
        $this->call(UsersDefaultSeeder::class);
    }
}

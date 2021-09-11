<?php

namespace Database\Seeders;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillsDefaultSeeder extends Seeder
{
    private array $skills = [
        'Assembly' => 1,
        'C' => 1,
        'C#' => 1,
        'C++' => 1,
        'Go' => 1,
        'Java' => 1,
        'Javascript' => 1,
        'Perl' => 1,
        'PHP' => 1,
        'Python' => 1,
        'R' => 1,
        'Ruby' => 1,
        'Rust' => 1,
        'SQL' => 1,
        'Swift' => 1,
        'Visual Basic .NET' => 1,
        'Visual Basic' => 1,
        'Angular.js' => 2,
        'ASP.NET' => 2,
        'Backbone.js' => 2,
        'Bootstrap' => 2,
        'Django' => 2,
        'Ember' => 2,
        'Express' => 2,
        'Flask' => 2,
        'jQuery' => 2,
        'Laravel' => 2,
        'Meteor' => 2,
        'Next.js' => 2,
        'Node.js' => 2,
        'React.js' => 2,
        'Ruby on Rails' => 2,
        'Spring' => 2,
        'Spring Boot' => 2,
        'Vue' => 2,
        'Alemão' => 3,
        'Árabe' => 3,
        'Chinês' => 3,
        'Espanhol' => 3,
        'Francês' => 3,
        'Hindi' => 3,
        'Inglês' => 3,
        'Italiano' => 3,
        'Japonês' => 3,
        'Português' => 3,
        'Russo' => 3,
    ];

    public function run(): void
    {
        foreach ($this->skills as $skill => $category) {
            Skill::updateOrCreate([
                'name' => $skill
            ],[
                'name' => $skill,
                'category_id' => $category
            ]);
        }
    }
}
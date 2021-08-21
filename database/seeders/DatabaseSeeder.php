<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Linguagens','Frameworks','Idiomas'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }

        $skills = [
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

        foreach ($skills as $skill=>$category) {
            Skill::create([
                'name' => $skill,
                'category_id' => $category
            ]);
        }


        $users = collect([
            (object)[
                'provider_user_id' => 'BeerAndCode',
                'nickname' => 'Beer And Code',
                'avatar' => 'https://avatars.githubusercontent.com/u/69223337?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => '33Piter',
                'nickname' => 'Piter',
                'avatar' => 'https://avatars.githubusercontent.com/u/67804835?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'RafaelBlum',
                'nickname' => 'Rafael Blum',
                'avatar' => 'https://avatars.githubusercontent.com/u/41844692?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'jailsoncarneiro',
                'nickname' => 'Jailson Carneiro',
                'avatar' => 'https://avatars.githubusercontent.com/u/11988275?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'patriciomartinns',
                'nickname' => 'Patrício Martins',
                'avatar' => 'https://avatars.githubusercontent.com/u/20000058?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'Ramaniks',
                'nickname' => 'Valdecir Neumann',
                'avatar' => 'https://avatars.githubusercontent.com/u/1359519?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => '12161003677',
                'nickname' => 'Eliezer Alves',
                'avatar' => 'https://avatars.githubusercontent.com/u/23661672?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'filipeamc',
                'nickname' => 'Filipe Costa',
                'avatar' => 'https://avatars.githubusercontent.com/u/5920120?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'jbgbruno',
                'nickname' => 'João Bruno Gomes',
                'avatar' => 'https://avatars.githubusercontent.com/u/12560490?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'Deathpk',
                'nickname' => 'Michel Versiani',
                'avatar' => 'https://avatars.githubusercontent.com/u/40901963?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'trollfalgar',
                'nickname' => 'Tiago Oliveira',
                'avatar' => 'https://avatars.githubusercontent.com/u/441455?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'webesistemas',
                'nickname' => 'Marco Túlio Lacerda',
                'avatar' => 'https://avatars.githubusercontent.com/u/7431548?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'felipe-balloni',
                'nickname' => 'Felipe Balloni Ferreira',
                'avatar' => 'https://avatars.githubusercontent.com/u/19998735?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'danilosampaioprepara',
                'nickname' => 'danilosampaioprepara',
                'avatar' => 'https://avatars.githubusercontent.com/u/80851888?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'renatokira',
                'nickname' => 'Renato Kira',
                'avatar' => 'https://avatars.githubusercontent.com/u/10859156?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'roberto-reis',
                'nickname' => 'José Roberto',
                'avatar' => 'https://avatars.githubusercontent.com/u/39444864?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'lucenarenato',
                'nickname' => 'Renato de Oliveira Lucena',
                'avatar' => 'https://avatars.githubusercontent.com/u/38870097?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'aeusteixeira',
                'nickname' => 'Matheus Teixeira',
                'avatar' => 'https://avatars.githubusercontent.com/u/40412362?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'joaonivaldo',
                'nickname' => 'Joao Nivaldo',
                'avatar' => 'https://avatars.githubusercontent.com/u/4040086?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'girordo',
                'nickname' => 'Tarcísio Giroldo Siqueira',
                'avatar' => 'https://avatars.githubusercontent.com/u/54643911?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'vs0uz4',
                'nickname' => 'Vitor Rodrigues',
                'avatar' => 'https://avatars.githubusercontent.com/u/2080547?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'cpereiraweb',
                'nickname' => 'Claudio Pereira',
                'avatar' => 'https://avatars.githubusercontent.com/u/1045328?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'luanfreitasdev',
                'nickname' => 'Luan Freitas',
                'avatar' => 'https://avatars.githubusercontent.com/u/33601626?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'jeffersonsevero',
                'nickname' => 'Jefferson Severo ',
                'avatar' => 'https://avatars.githubusercontent.com/u/37408502?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'LucasSouzaa',
                'nickname' => 'Virgu',
                'avatar' => 'https://avatars.githubusercontent.com/u/8497589?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'Reinaldo92',
                'nickname' => 'Reinaldo Jr',
                'avatar' => 'https://avatars.githubusercontent.com/u/39837626?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'marciojduarte',
                'nickname' => 'Márcio J. Duarte',
                'avatar' => 'https://avatars.githubusercontent.com/u/45566764?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'josedafonsecajr',
                'nickname' => 'josedafonsecajr',
                'avatar' => 'https://avatars.githubusercontent.com/u/58943299?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'celsodavid',
                'nickname' => 'Celso David',
                'avatar' => 'https://avatars.githubusercontent.com/u/5132545?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'guilhermepolicarpo',
                'nickname' => 'Guilherme Policarpo Silva',
                'avatar' => 'https://avatars.githubusercontent.com/u/13804537?v=4',
                'data' => '[]'
            ],
            (object)[
                'provider_user_id' => 'renanlmd',
                'nickname' => 'Renan Almeida',
                'avatar' => 'https://avatars.githubusercontent.com/u/30695713?v=4',
                'data' => '[]'
            ],
        ]);

        foreach ($users as $user) {
            $userInsert = User::create([
                'name' => $user->nickname,
                'email' => strtolower($user->provider_user_id).'@adoteum.dev',
                'password' => Hash::make('password'),
            ]);

            $profile = Profile::create([
                'user_id' => $userInsert->id,
                'provider' => 'GITHUB',
                'provider_user_id' => $user->provider_user_id,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
                'data' => '{}',
            ]);
        }
    }
}

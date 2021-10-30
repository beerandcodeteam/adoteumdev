<?php

use App\Models\User;
use App\Models\Action;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Components\DevelopersScreen;
use function Pest\Livewire\livewire;

it('lists developers according to rules', function () {

    //Reset
    DB::table('actions')->truncate();
    DB::table('knowledge')->truncate();
    DB::table('interests')->truncate();

    // Let's add  skills to users
    $me = User::find(1);
    $peer2 = User::find(2);
    $peer3 = User::find(3);
    $peer4 = User::find(4);
    $peer5 = User::find(5);
    $peer6 = User::find(6);

    $me->knowledge()->createMany(getPhpSkill($level = 5));
    $me->interests()->createMany(getPhpSkill($level = 5));

    //Add php level 9 to everybody
    $peer2->knowledge()->createMany(getPhpSkill());
    $peer2->interests()->createMany(getPhpSkill());

    $peer3->knowledge()->createMany(getPhpSkill());
    $peer3->interests()->createMany(getPhpSkill());

    $peer4->knowledge()->createMany(getPhpSkill());
    $peer4->interests()->createMany(getPhpSkill());

    $peer5->knowledge()->createMany(getPhpSkill());
    $peer5->interests()->createMany(getPhpSkill());

    //Should not appear, level is not enough
    $peer6->knowledge()->createMany(getPhpSkill($level = 4));
    $peer6->interests()->createMany(getPhpSkill($level = 4));

    // I gave a like to these user 2 and is NOT expired.
    Action::create([
        'from_user_id'  => $me->id,
        'to_user_id'    => $peer2->id,
        'name'          => 'LIKE',
        'expiration_at' =>  Carbon::now()->addDays(5)->format('Y-m-d'),
    ]);

    // I gave a like to these user 3 and IS expired.
    Action::create([
        'from_user_id'  => $me->id,
        'to_user_id'    => $peer3->id,
        'name'          => 'LIKE',
        'expiration_at' => '2020-01-01',
    ]);

    actingAs($me->load('profile'));

    //I should not see user #2, it's not expired.
    //I should see users 3,4,5 who matches my interests. Total: 3 users.
    livewire(DevelopersScreen::class)
        ->call('getDevelopers')
        ->assertSet("developers.total", '3')
        ->assertSet("developers.data.0.id", '3')
        ->assertSet("developers.data.1.id", '4')
        ->assertSet("developers.data.2.id", '5');
});

function getPhpSkill($level = 9): array
{
    return [['skill_id' => 9, 'level' => $level]];
}

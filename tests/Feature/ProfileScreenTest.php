<?php

    use App\Http\Livewire\Components\ProfileScreen;
    use App\Models\Profile;
    use App\Models\User;
    use Illuminate\Http\UploadedFile;
    use function Pest\Laravel\get;

it('checks if ProfileScreen required auth', function () {
    get('/profile')
        ->assertRedirect('/home');
});

it('checks if ProfileScreen Component was rendered with auth', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'))
    ->get(route('app.profile'))
        ->assertSeeLivewire('components.profile-screen');
});

it('checks if ProfileScreen Component was upload avatar', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    $file = UploadedFile::fake()->image("avatar.png");
    $nameAvatar = "avatar{$user->id}.png";

    actingAs($user->load('profile'))
        ->livewire(ProfileScreen::class)
        ->set('imageProfile', $file)
        ->call('storeAvatar');
    $profile = Profile::where('user_id', $user->id)->first();

    $this->assertEquals($profile->avatar, url("storage/avatarProfile/{$nameAvatar}"));

    Storage::assertExists("avatarProfile/{$nameAvatar}");
});

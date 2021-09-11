<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('provider', ['GITHUB', 'GOOGLE']);
            $table->string('provider_user_id');
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->json('data');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

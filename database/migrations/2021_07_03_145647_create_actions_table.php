<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users');
            $table->foreignId('to_user_id')->constrained('users');
            $table->enum('name', ['LIKE', 'DISLIKE', 'SUPERLIKE']);
            $table->date('expiration_at');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};

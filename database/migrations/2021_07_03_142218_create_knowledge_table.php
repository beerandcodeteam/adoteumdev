<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('knowledge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('skill_id')->constrained();
            $table->integer('level');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('knowledge');
    }
};

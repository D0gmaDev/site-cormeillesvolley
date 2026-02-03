<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('genre', ['M', 'F', 'Mixte']);
            $table->enum('section', ['Seniors', 'Jeunes', 'Ecole de Volley', 'Loisirs', 'FSGT']);
            $table->string('niveau')->nullable();
            $table->string('photo')->nullable();
            $table->string('ffvolley_embed_url')->nullable();
            $table->timestamps();
        });

        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('team_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->integer('number')->nullable();
            $table->string('position');
            $table->timestamps();

            $table->unique(['team_id', 'player_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_player');
        Schema::dropIfExists('players');
        Schema::dropIfExists('teams');
    }
};

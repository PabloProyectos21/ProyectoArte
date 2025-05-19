<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_publication_favorite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'publication_id']); // para evitar duplicados
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_publication_favorite');
    }
};


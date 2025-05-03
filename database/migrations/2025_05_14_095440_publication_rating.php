<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publication_ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');

            $table->primary(['user_id', 'publication_id']); // Clave compuesta para evitar duplicados
            $table->timestamps();
        });

    }
        public function down(): void
    {
        Schema::dropIfExists('publication_ratings');
    }
};


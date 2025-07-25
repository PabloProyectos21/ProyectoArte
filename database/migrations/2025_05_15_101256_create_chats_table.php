<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable(); // Nombre para chat grupal, puede ser null para privados
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('chats');
    }
};


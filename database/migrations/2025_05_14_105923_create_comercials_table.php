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
        Schema::create('commercials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Admin que crea el anuncio
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); // Empresa anunciante
            $table->string('media_url');
            $table->string('image');
            $table->date('publication_date');
            $table->date('expiration_date');
            $table->unsignedBigInteger('clicks')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comercials');
    }
};

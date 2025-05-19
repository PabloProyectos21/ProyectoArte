<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comment_ratings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('comment_id')->constrained()->onDelete('cascade');
            $table->boolean('like')->default(true);
            $table->timestamps();

            $table->primary(['user_id', 'comment_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comment_ratings');
    }
};



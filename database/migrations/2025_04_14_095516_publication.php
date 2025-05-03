<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('image_route');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('number_of_ratings')->default(0);
            $table->float('clicks')->default(0);
            $table->enum('category', ['photography', 'tattoos', 'painting', 'draws', 'fashion', 'other'])->default('other');
            $table->timestamp('publication_date')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};

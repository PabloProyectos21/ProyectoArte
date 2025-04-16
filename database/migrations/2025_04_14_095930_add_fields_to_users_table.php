<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname', 50)->nullable();
            $table->enum('user_permission_level', ['user', 'admin'])->default('user');
            $table->string('profile_picture')->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['surname', 'user_permission_level', 'profile_picture', 'description']);
        });
    }
};

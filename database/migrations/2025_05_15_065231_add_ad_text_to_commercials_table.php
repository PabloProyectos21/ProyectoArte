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
        Schema::table('commercials', function (Blueprint $table) {
            $table->string('ad_text')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('commercials', function (Blueprint $table) {
            $table->dropColumn('ad_text');
        });
    }

};

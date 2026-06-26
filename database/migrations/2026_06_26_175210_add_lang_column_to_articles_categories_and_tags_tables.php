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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('lang')->default('en')->after('id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('lang')->default('en')->after('id');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('lang')->default('en')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('lang');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('lang');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
    }
};

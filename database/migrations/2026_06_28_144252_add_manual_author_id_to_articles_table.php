<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('manual_author_id')
                  ->nullable()
                  ->after('author_id')
                  ->constrained('manual_authors')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['manual_author_id']);
            $table->dropColumn('manual_author_id');
        });
    }
};

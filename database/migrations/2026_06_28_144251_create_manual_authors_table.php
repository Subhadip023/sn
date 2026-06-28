<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manual_authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(1); // 1 means active, 0 means inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_authors');
    }
};

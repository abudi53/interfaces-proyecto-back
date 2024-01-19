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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo', 100)->nullable(false);
            $table->string('autor', 100)->nullable(false);
            $table->string('editorial', 100)->nullable(false);
            $table->string('genero', 100)->nullable(false);
            $table->string('fecha', 100)->nullable(false);
            $table->string('foto', 100)->nullable(false);
            $table->string('pdf', 100)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

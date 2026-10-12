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
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained('jenises')->onDelete('cascade');
            $table->string('nama');
            $table->string('luas');
            $table->string('wakif');
            $table->string('alamat'); 
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->foreignId('nadzir_id')->constrained('nadzirs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanahs');
    }
};

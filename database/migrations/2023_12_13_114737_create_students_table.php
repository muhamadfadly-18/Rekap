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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->char('nis');
            $table->string('name');
            $table->unsignedBigInteger('rombel_id');
            $table->foreign('rombel_id')->references('id')->on('rombels');
            $table->unsignedBigInteger('rayon_id');
            $table->foreign('rayon_id')->references('id')->on('rayons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

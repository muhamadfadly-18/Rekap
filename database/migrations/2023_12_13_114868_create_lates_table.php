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
        Schema::create('lates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Tambahkan kolom student_id
            $table->dateTime('date_time');
            $table->text('information');
            $table->text('bukti');
            $table->timestamps();

            // Definisikan foreign key untuk student_id
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lates');
    }
};

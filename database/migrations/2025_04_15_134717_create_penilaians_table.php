<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('penilaians', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kriteria_id');
        $table->unsignedBigInteger('karyawan_id');
        $table->float('nilai');
        $table->timestamps();

        $table->foreign('kriteria_id')
              ->references('id')->on('kriterias')
              ->onDelete('cascade');

        $table->foreign('karyawan_id')
              ->references('id')->on('karyawans')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};

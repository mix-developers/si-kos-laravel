<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas_tambahan_kos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kos');
            $table->string('nama_fasilitas');
            $table->integer('jumlah')->default(1);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_kos')->references('id')->on('kos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas_tambahan_kos');
    }
};

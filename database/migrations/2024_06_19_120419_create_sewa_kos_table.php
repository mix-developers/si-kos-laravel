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
        Schema::create('sewa_kos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kos');
            $table->foreignId('id_user');
            $table->string('nama_penyewa');
            $table->integer('jumlah_orang');
            $table->integer('jangka_waktu');
            $table->date('tanggal_sewa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sewa_kos');
    }
};

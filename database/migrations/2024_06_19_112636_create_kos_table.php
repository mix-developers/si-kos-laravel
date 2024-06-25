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
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('nama_kos');
            $table->string('nama_pemilik');
            $table->integer('jumlah_pintu');
            $table->integer('harga_kos');
            $table->enum('jangka_waktu', ['Bulanan', 'Tahunan']);
            $table->string('latitude');
            $table->string('longitude');
            $table->text('ketentuan_kos');
            $table->text('keterangan_kos');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kos');
    }
};

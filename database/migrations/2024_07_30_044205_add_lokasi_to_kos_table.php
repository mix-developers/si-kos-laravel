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
        Schema::table('kos', function (Blueprint $table) {
            $table->foreignId('id_jalan')->nullable()->after('status');
            $table->foreignId('id_kelurahan')->nullable()->after('id_jalan');


            $table->foreign('id_kelurahan')->references('id')->on('kelurahan');
            $table->foreign('id_jalan')->references('id')->on('jalan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kos', function (Blueprint $table) {
            //
        });
    }
};

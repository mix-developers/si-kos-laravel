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
        Schema::table('fasilitas_umum_kos', function (Blueprint $table) {
            $table->enum('ketersediaan', ['Y', 'N'])->default('N')->after('keterangan');
            $table->enum('milik', ['Pribadi', 'Bersama'])->default('Pribadi')->after('ketersediaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fasilitas_umum_kos', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::table('fasilitas_tambahan_kos', function (Blueprint $table) {
            $table->enum('milik', ['Pribadi', 'Bersama'])->default('Pribadi')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fasilitas_tambahan_kos', function (Blueprint $table) {
            //
        });
    }
};

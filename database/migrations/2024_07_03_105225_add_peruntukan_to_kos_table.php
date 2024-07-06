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
            $table->enum('peruntukan', ['Putri', 'Putra', 'Campuran'])->default('Campuran')->after('harga_kos');
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

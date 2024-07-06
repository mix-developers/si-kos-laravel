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
            $table->string('foto_1')->after('id_user');
            $table->string('foto_2')->after('foto_1');
            $table->string('foto_3')->after('foto_2');
            $table->string('foto_4')->after('foto_3')->nullable();
            $table->string('foto_5')->after('foto_4')->nullable();
            $table->string('foto_6')->after('foto_5')->nullable();
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

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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('square')->nullable();
            $table->string('deadline')->nullable();
            $table->string('storeys')->nullable();
            $table->string('finishing')->nullable();
            $table->integer('layout_id');
            $table->integer('type_id');
            $table->integer('city_id');
            $table->integer('region_id');
            $table->integer('distance_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('square');
            $table->dropColumn('deadline');
            $table->dropColumn('storeys');
            $table->dropColumn('finishing');
            $table->dropColumn('layout_id');
            $table->dropColumn('type_id');
            $table->dropColumn('city_id');
            $table->dropColumn('region_id');
            $table->dropColumn('distance_id');
        });
    }
};

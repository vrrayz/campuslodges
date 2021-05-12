<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraInfoInLodges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lodges', function (Blueprint $table) {
            //
            $table->string('vicinity')->after('location');
            $table->string('description')->after('who_can_rent');
            $table->integer('price')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lodges', function (Blueprint $table) {
            //
        });
    }
}

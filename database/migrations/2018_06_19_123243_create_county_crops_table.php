<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountyCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('county_crops', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sub_county_id');
            $table->unsignedInteger('crop_id');
            $table->timestamps();

            $table->foreign('sub_county_id')->references('id')->on('sub_counties')->onDelete('cascade');
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('county_crops');
    }
}

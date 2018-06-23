<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMitigationPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitigation_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crop_id');
            $table->string('mitigation_plan');
            $table->timestamps();

            $table->foreign('crop_id')->references('id')->on('mitigation_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitigation_plans');
    }
}

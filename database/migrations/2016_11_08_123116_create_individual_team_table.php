<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_team', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('individual_id');
            $table->unsignedInteger('team_id');
            $table->timestamps();

            $table->foreign('individual_id')->references('id')->on('individuals');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_individual');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueIndexToIndividualTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('individual_team', function (Blueprint $table) {
            $table->unique(['individual_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('individual_team', function (Blueprint $table) {
            $table->dropUnique(['individual_id', 'team_id']);
        });
    }
}

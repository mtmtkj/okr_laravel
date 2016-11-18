<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnInObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objectives', function (Blueprint $table) {
            $table->renameColumn('evaluatable_id', 'ownable_id');
            $table->renameColumn('evaluatable_type', 'ownable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objectives', function (Blueprint $table) {
            $table->renameColumn('ownable_id', 'evaluatable_id');
            $table->renameColumn('ownable_type', 'ownable_id');
        });
    }
}

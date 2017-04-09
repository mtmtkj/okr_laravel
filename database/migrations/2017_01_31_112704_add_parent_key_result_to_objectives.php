<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentKeyResultToObjectives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objectives', function (Blueprint $table) {
            $table->unsignedInteger('parent_key_result_id')->nullable()->after('ownable_type');
            $table->foreign('parent_key_result_id')->references('id')->on('key_results');
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
            $table->dropForeign('objectives_parent_key_result_id_foreign');
            $table->dropColumn('parent_key_result_id');
        });
    }
}

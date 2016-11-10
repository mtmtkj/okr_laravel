<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToKeyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('key_results', function (Blueprint $table) {
            $table->float('target_value', 8, 2)->after('description');
            $table->string('target_unit', 8)->after('target_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('key_results', function (Blueprint $table) {
            $table->dropColumn('target_value');
            $table->dropColumn('target_unit');
        });
    }
}

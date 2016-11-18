<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnInInputPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_periods', function (Blueprint $table) {
            $table->dropColumn('evaluatee_type');
            $table->enum('objective_owner_type', ['organization', 'team', 'individual'])->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('input_periods', function (Blueprint $table) {
            $table->dropColumn('objective_owner_type');
            $table->enum('evaluatee_type', ['organization', 'team', 'individual'])->after('name');
        });
    }
}

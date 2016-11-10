<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFulfilmentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulfilment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('key_result_id');
            $table->float('fulfilled_value', 8, 2);
            $table->timestamps();

            $table->foreign('key_result_id')->references('id')->on('key_results');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fulfilment_histories');
    }
}

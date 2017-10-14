<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_organization', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('individual_id');
            $table->unsignedInteger('organization_id');
            $table->timestamps();

            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_organization');
    }
}

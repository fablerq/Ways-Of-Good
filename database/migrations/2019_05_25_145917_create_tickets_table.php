<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('organization_id')->unsigned()->nullable();
            $table->integer('advancedticket_id')->unsigned()->nullable();
            $table->integer('place_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->boolean('isEat')->default(false);
            $table->boolean('isSleep')->default(false);
            $table->boolean('isMed')->default(false);
            $table->boolean('isHeat')->default(false);
            $table->boolean('isDry')->default(false);
            $table->boolean('isWork')->default(false);
            $table->string('title');
            $table->string('description');
            $table->integer('availableVisitors');
            $table->string('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}

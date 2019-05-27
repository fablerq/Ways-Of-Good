<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvancedTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanced_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('startInterval');
            $table->string('endInterval');
            $table->boolean('isMonday')->default(false);
            $table->boolean('isSleep')->default(false);
            $table->boolean('isTuesday')->default(false);
            $table->boolean('isWednesday')->default(false);
            $table->boolean('isThursday')->default(false);
            $table->boolean('isFriday')->default(false);
            $table->boolean('isSaturday')->default(false);
            $table->boolean('isSunday')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advanced_tickets');
    }
}

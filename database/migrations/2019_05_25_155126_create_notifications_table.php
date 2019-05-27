<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('place_id')->unsigned()->nullable();
            $table->dateTime('created_at');
            $table->dateTime('aboutTime');
            $table->dateTime('endOfTicket');
            $table->string('name')->default('Аноним');
            $table->string('sex')->default('underfined');
            $table->string('code')->default('underfined');
            $table->string('secretKey')->default('underfined');
            $table->boolean('isCame')->default(false);
            $table->string('adress')->default('underfined');
            $table->boolean('isEat')->default(false);
            $table->boolean('isSleep')->default(false);
            $table->boolean('isMed')->default(false);
            $table->boolean('isHeat')->default(false);
            $table->boolean('isDry')->default(false);
            $table->boolean('isWork')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

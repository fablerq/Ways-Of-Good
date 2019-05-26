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
            $table->string('data')->default('10:00');
            $table->string('name')->default('Аноним');
            $table->string('sex')->default('undefined');
            $table->string('code')->default('Пусто');
            $table->string('secretKey')->default('emptysecretkey');
            $table->boolean('isCame')->default(false);
            $table->string('adress')->default('undefiend');
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

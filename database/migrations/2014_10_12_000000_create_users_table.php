<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('telegram_user_id')->unique();
            $table->string('first_name',50);
            $table->string('last_name',50)->nullable();
            $table->string('user_name',50)->nullable();
            $table->string('language_code',4)->default('en');
            $table->boolean('is_bot');
            $table->char('pay_amount',8)->default(0);
            $table->unsignedSmallInteger('invite_score')->default(0);
            $table->boolean('was_invited')->default(0);
            $table->boolean('channel')->default(0);
            $table->string('country',32)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

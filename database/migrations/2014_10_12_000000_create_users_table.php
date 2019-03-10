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
            $table->string('first_name',63);
            $table->string('last_name',63)->nullable();
            $table->string('user_name',63)->nullable();
            $table->string('language_code',15)->default('en-Us');
            $table->boolean('is_bot');
            $table->char('pay_amount',15)->default(0);
            $table->unsignedSmallInteger('invite_score')->default(0);
            $table->boolean('was_invited')->default(0);
            $table->boolean('channel')->default(0);
            $table->string('country',31)->nullable();
            $table->string('user_step',31)->default('start');
            $table->rememberToken();
            $table->timestamps();
            $table->index('id');
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

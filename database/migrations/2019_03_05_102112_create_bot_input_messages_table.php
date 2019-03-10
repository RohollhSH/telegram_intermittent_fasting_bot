<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBotInputMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_input_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->bigInteger('update_id')->unique();
            $table->bigInteger('message_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->dateTime('date_sent_at');
            $table->json('json_input');
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
        Schema::dropIfExists('bot_input_messages');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactionToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reaction_to_messages', function (Blueprint $table) {
            $table->id();
            $table->String('emoji');
            $table->unsignedBigInteger('reacted_by')->nullable();
            $table->unsignedBigInteger('message_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('reacted_by')->references('id')->on('users');
            $table->foreign('message_id')->references('id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reaction_to_messages');
    }
}

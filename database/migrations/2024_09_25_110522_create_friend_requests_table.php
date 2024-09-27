<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requester_user_id')->nullable();
            $table->unsignedBigInteger('requesting_user_id')->nullable();
            $table->unsignedBigInteger('request_status_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('requester_user_id')->references('id')->on('users');
            $table->foreign('requesting_user_id')->references('id')->on('users');
            $table->foreign('request_status_id')->references('id')->on('request_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend_requests');
    }
}

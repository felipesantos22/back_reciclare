<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_notification');
            $table->unsignedBigInteger('id_user');
            $table->boolean('seen')->default(false);
            $table->timestamp('date_seen')->nullable();
            $table->timestamps();
            $table->foreign('id_notification')->references('id')->on('notifications')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_users');
    }
};

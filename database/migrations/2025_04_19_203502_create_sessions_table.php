<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('revision_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Who you're meeting
            $table->time('time');
            $table->date('date');
            $table->enum('status', ['confirmed', 'pending', 'missed'])->default('pending');
            $table->unsignedBigInteger('user_id'); // Owner of the session (user)
            $table->unsignedBigInteger('partner_id'); // Partner for the session
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}

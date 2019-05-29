<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('backdropPath')->unique()->nullable();
            $table->string('imagePath')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('userId')->unique();
            $table->bigInteger('subscriber')->default(0);
            $table->boolean('isVerified')->default(0);
            $table->foreign('userId')->on('users')->references('id');
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
        Schema::dropIfExists('channel');
    }
}

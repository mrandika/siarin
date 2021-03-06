<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_data', function (Blueprint $table) {
            $table->string('id');
            $table->unsignedBigInteger('uploadId')->unique();
            $table->foreign('uploadId')->on('uploads')->references('id');
            $table->unsignedBigInteger('categoriesId')->unique();
            $table->foreign('categoriesId')->on('categories')->references('id');
            $table->bigInteger('views')->default(0);
            $table->bigInteger('likes')->default(0);
            $table->bigInteger('dislikes')->default(0);
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
        Schema::dropIfExists('upload_data');
    }
}

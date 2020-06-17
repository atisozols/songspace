<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->integer('library_id')->unsigned();
            $table->string('title');
            $table->string('lyrics');
            $table->string('audio');
            $table->timestamps();
        });
        Schema::table('songs', function (Blueprint $table) {
            $table->foreign('library_id')->references('id')->on('libraries');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}

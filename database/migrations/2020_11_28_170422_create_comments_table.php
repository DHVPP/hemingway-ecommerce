<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('username');
            $table->unsignedBigInteger('idPost');
            $table->unsignedBigInteger('idUser')->nullable();
            $table->unsignedBigInteger('idComment')->nullable();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idPost')->references('id')->on('posts');
            $table->foreign('idComment')->references('id')->on('comments');
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
        Schema::dropIfExists('comments');
    }
}

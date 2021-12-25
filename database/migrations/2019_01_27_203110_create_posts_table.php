<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('details')->nullable();
            $table->string('address');
            $table->string('number_of_room')->nullable();
            $table->string('number_of_bath')->nullable();
            $table->string('roommat_number')->nullable();
            $table->string('family_bachelor')->nullable();
            $table->string('conditions')->nullable();
            $table->integer('rent')->unsigned();
            $table->string('approve')->default('false');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

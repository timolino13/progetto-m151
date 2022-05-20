<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hikes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->double('rating')->nullable();
            $table->boolean('done')->default(false);
            $table->double('difficulty')->nullable();
            $table->double('distance')->nullable();
            $table->string('duration')->nullable();
            $table->string('startLocation')->nullable();
            $table->string('endLocation')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hikes');
    }
}

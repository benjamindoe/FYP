<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('primary_colour')->nullable();
            $table->string('secondary_colour')->nullable();
            $table->integer('points');
            $table->timestamps();
        });

        Schema::create('house_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('points');
            $table->string('reason');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('house_id');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('staff');
            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('house_id')->references('id')->on('houses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_points');
        Schema::dropIfExists('houses');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_teacher', function (Blueprint $table) {
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('class_id');
            $table->primary(['staff_id', 'class_id']);

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
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
        Schema::dropIfExists('class_teacher');
    }
}

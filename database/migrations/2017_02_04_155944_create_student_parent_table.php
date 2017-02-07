<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('student_parent'))
        {
            Schema::create('student_parent', function (Blueprint $table) {
                $table->unsignedInteger('student_id');
                $table->unsignedInteger('parent_id');
                $table->primary(['student_id','parent_id']);
                $table->integer('priority');
                $table->string('relation');
                $table->timestamps();
            });
        }

        Schema::table('student_parent', function (blueprint $table) {
            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parent')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_parent');
    }
}

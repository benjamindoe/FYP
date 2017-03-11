<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string("legal_surname");
            $table->string("legal_forename");
            $table->string("middle_names")->nullable();
            $table->string("preferred_surname")->nullable();
            $table->string("preferred_forename")->nullable();
            $table->date("dob");
            $table->string("gender");
            $table->text("notes")->nullable('');
            $table->softDeletes();
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
        Schema::dropIfExists('student');
    }
}

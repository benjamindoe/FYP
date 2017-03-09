<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSchoolHistoryStudentSchoolFks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_history', function (Blueprint $table) {
            $table->unsignedInteger('school_urn');
            $table->unsignedInteger('student_id');
            $table->foreign('school_urn')->references('unique_reference_number')->on('school');
            $table->foreign('student_id')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_history', function (Blueprint $table) {
            $table->dropForeign(['school_urn']);
            $table->dropForeign(['student_id']);
            $table->dropColumn(['school_urn', 'student_id']);
        });
    }
}

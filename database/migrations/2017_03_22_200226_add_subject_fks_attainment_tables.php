<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectFksAttainmentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attainment_targets', function (Blueprint $table) {
            $table->foreign('subject_id')->references('id')->on('subject');
            $table->foreign('student_id')->references('id')->on('student');
        });
        Schema::table('attainment_record', function (Blueprint $table) {
            $table->unsignedInteger('period')->change();
            $table->foreign('period')->references('id')->on('attainment_periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attainment_targets', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['subject_id']);
        });
        Schema::table('attainment_record', function (Blueprint $table) {
            $table->dropForeign(['period']);
            $table->string('period')->change();
        });
    }
}

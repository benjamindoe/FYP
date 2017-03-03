<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchoolFkInClassStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff', function($table) {
            $table->unsignedInteger('school_urn');

            $table->foreign('school_urn')->references('unique_reference_number')->on('school')->onDelete('cascade');
        });

        Schema::table('class', function($table) {
            $table->unsignedInteger('school_urn');

            $table->foreign('school_urn')->references('unique_reference_number')->on('school')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function($table) {
            $table->dropForeign(['school_urn']);
            $table->dropColumn('school_urn');
        });

        Schema::table('class', function($table) {
            $table->dropForeign(['school_urn']);
            $table->dropColumn('school_urn');
        });
    }
}

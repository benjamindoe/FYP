<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompositeUniqueKeyInClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class', function (Blueprint $table) {
            $table->unique(['class_form', 'academic_year'], 'class_class_form_academic_year_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class', function (Blueprint $table) {
            $table->dropUnique('class_class_form_academic_year_unique');
        });
    }
}

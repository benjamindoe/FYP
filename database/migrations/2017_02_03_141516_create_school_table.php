<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school', function (Blueprint $table) {
            $table->unsignedInteger('unique_reference_number')->primary();
            $table->unsignedInteger('la_number');
            $table->string('la_name');
            $table->unsignedInteger('establishment_number');
            $table->string('establishment_name');
            $table->string('establishment_type');
            $table->string('establishment_type_group');
            $table->string('establishment_status');
            $table->string('education_phase');
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
        Schema::dropIfExists('school');
    }
}

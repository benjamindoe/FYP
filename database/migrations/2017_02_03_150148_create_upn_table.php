<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upn', function (Blueprint $table) {
            $table->string('upn');
            $table->primary('upn');
            $table->char('check_letter', 1); // This letter, calculated using the digits at characters 2 - 13 verifies a UPN’s validity. 
            $table->tinyInteger('la_number'); // A 3-digit number, unique to each LA, allocated by DfE.
            $table->smallInteger('establishment_number'); // A 4-digit number, unique to each school/academy, allocated by DfE.
            $table->tinyInteger('year_code'); // A 2-digit number, comprising the last 2 numbers of the academic year in which the UPN is allocated.
            $table->tinyInteger('serial_number'); // A 3-digit number, unique to each UPN allocated by a school/academy in a given year.
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
        Schema::dropIfExists('upn');
    }
}

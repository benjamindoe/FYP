<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiblingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sibling', function (Blueprint $table) {
            $table->integer('student_id1')->unsigned();
            $table->integer('student_id2')->unsigned();
            $table->primary(['student_id1', 'student_id2']);
            $table->string('relation')->default('sibling');
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
        Schema::dropIfExists('sibling');
    }
}

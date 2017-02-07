<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttainmentRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attainment_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('grade');
            $table->string('period');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('attainment_record',  function (Blueprint $table) {
            $table->foreign('subject_id')
                ->references('id')->on('subject')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')
                ->on('student')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attainment_record');
    }
}

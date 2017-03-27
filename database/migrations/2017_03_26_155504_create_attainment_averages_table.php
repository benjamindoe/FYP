<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttainmentAveragesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attainment_averages', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('subject_id');
			$table->unsignedInteger('year_group');
			$table->unsignedInteger('avg_grade');
			$table->timestamps();

			$table->foreign('subject_id')->references('id')->on('subject');
			$table->foreign('avg_grade')->references('id')->on('attainment_grades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('attainment_averages');
	}
}

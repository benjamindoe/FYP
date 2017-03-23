<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttainmentTargetsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attainment_targets', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('subject_id');
			$table->unsignedInteger('student_id');
			$table->string('grade');
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
		Schema::dropIfExists('attainment_targets');
	}
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttainmentFks extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attainment_record', function (Blueprint $table) {
			$table->unsignedInteger('grade')->change();
			$table->foreign('grade')->references('id')->on('attainment_grades');
		});

		Schema::table('attainment_targets', function(Blueprint $table) {
			$table->foreign('grade')->references('id')->on('attainment_grades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attainment_record', function (Blueprint $table) {
			$table->dropForeign(['grade']);
			$table->string('grade')->change();
		});

		Schema::table('attainment_targets', function(Blueprint $table) {
			$table->string('grade')->change();
		});
	}
}

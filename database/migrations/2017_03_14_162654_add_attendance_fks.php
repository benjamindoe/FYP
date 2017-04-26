<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttendanceFks extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attendance', function($table) {
			$table->foreign('period')->references('period')->on('registration_periods');

			$table->foreign('code')->references('code')->on('attendance_codes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attendance', function($table) {
			$table->dropForeign(['period']);
			$table->dropForeign(['code']);
		});
	}
}

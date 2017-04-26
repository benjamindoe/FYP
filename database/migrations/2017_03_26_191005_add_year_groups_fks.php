<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYearGroupsFks extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attainment_averages', function (Blueprint $table) {
			$table->foreign('year_group')->references('id')->on('year_groups');
		});
		Schema::table('student', function (Blueprint $table) {
			$table->foreign('year_group')->references('id')->on('year_groups');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student', function (Blueprint $table) {
			$table->dropForeign(['year_group']);
		});
        Schema::table('attainment_averages', function (Blueprint $table) {
			$table->dropForeign(['year_group']);
        });
	}
}

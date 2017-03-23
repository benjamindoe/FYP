<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttainmentPeriodsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attainment_periods', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unqiue();
			$table->date('milestone');
			$table->string('description')->nullable();
			$table->timestamps();
		});

		DB::table('attainment_periods')->insert([
			['name' => 'Autumn Half',	'milestone' => '2016-10-21'],
			['name' => 'Autumn', 		'milestone' => '2016-12-20'],
			['name' => 'Spring Half',	'milestone' => '2017-02-10'],
			['name' => 'Spring',		'milestone' => '2017-03-31'],
			['name' => 'Summer Half',	'milestone' => '2017-05-26'],
			['name' => 'Summer',		'milestone' => '2017-07-25'],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('attainment_periods');
	}
}

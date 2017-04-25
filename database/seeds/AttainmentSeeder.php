<?php

use Illuminate\Database\Seeder;

class AttainmentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('attainment_periods')->insert([
			['name' => 'Autumn Half',	'milestone' => '2016-10-21'],
			['name' => 'Autumn', 		'milestone' => '2016-12-20'],
			['name' => 'Spring Half',	'milestone' => '2017-02-10'],
			['name' => 'Spring',		'milestone' => '2017-03-31'],
			['name' => 'Summer Half',	'milestone' => '2017-05-26'],
			['name' => 'Summer',		'milestone' => '2017-07-25'],
		]);
	}
}

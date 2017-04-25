<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
			['name' => 'Autumn Half',	'milestone' => '2016-10-21', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['name' => 'Autumn', 		'milestone' => '2016-12-20', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['name' => 'Spring Half',	'milestone' => '2017-02-10', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['name' => 'Spring',		'milestone' => '2017-03-31', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['name' => 'Summer Half',	'milestone' => '2017-05-26', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['name' => 'Summer',		'milestone' => '2017-07-25', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
		]);

		DB::table('attainment_grades')->insert([
			['code' => 'E', 'precedance' => '0', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['code' => 'D', 'precedance' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['code' => 'C', 'precedance' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['code' => 'B', 'precedance' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
			['code' => 'A', 'precedance' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
		]);
	}
}

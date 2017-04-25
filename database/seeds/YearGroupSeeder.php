<?php

use Illuminate\Database\Seeder;

class YearGroupSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('year_groups')->insert([
			['group' => 'Reception',	'keystage' => 'Early Years'],
			['group' => '1',			'keystage' => 'KS1'],
			['group' => '2',			'keystage' => 'KS1'],
			['group' => '3',			'keystage' => 'KS2'],
			['group' => '4',			'keystage' => 'KS2'],
			['group' => '5',			'keystage' => 'KS2'],
			['group' => '6',			'keystage' => 'KS2'],
		]);
	}
}

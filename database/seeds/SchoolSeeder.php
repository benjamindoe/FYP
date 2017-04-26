<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SchoolSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$urn = 139349;
		$addressId = DB::table('address')->insert([
			'address_line_1' => 'Lantern Lane Primary School',
			'address_line_2' => 'Lantern Lane',
			'locality' => 'East Leake',
			'postcode' => 'LE12 6QN',
			'city' => 'Lougborough',
			'county' => 'Leicestershire',
			'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
		]);

		DB::table('school')->insert([
			'unique_reference_number' => $urn,
			'la_number' => '891',
			'la_name' => 'Nottinghamshire',
			'establishment_number' => '2731',
			'establishment_name' => 'Lantern Lane Primary School',
			'establishment_status' => 'Open',
			'education_phase' => 'Primary',
			'address_id' => $addressId,
			'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
		]);

		DB::table('academic_years')->insert([
			'academic_year' => 2016,
			'year_start' => Carbon::createFromDate(2016, 9, 6),
			'year_end' => Carbon::createFromDate(2017, 7, 25),
			'school_urn' => $urn,
		]);

		DB::table('class')->insert([
			['class_form' => '3AA', 'school_urn' => $urn, 'academic_year' => 1],
			['class_form' => '4BB', 'school_urn' => $urn, 'academic_year' => 1]
		]);
	}
}

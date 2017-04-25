<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(SchoolSeeder::class);
		$this->call(YearGroupSeeder::class);
		$this->call(AttainmentSeeder::class);
		$this->call(AttendanceSeeder::class);
		$this->call(ParentSeeder::class);
		$this->call(StaffSeeder::class);
		$this->call(StudentSeeder::class);
	}
}

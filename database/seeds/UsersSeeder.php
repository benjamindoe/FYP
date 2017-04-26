<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			'username' => 'admin',
			'password' => bcrypt('password'),
			'is_super_admin' => 1,
			'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()
		]);
	}
}

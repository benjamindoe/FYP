<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$staff = factory(App\Model\Staff::class)->create(['role' => 'admin']);
		$staff->user()->save(factory(App\User::class)->make(['username' => 'admin.'.$staff->forename.$staff->surname]));
		factory(App\Model\Staff::class, 5)->create()->each( function ($s) {
			$class = App\Model\Classes::inRandomOrder()->first();
			$s->classes()->attach($class->id);
			$s->user()->save(factory(App\User::class)->make(['username' => 't.'.$s->forename.$s->surname]));
		});
	}
}

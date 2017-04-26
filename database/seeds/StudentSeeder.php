<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Model\Student::class, 20)->create()->each( function ($s) {
			$s->user()->save(factory(App\User::class)->make(['username' => 's.'.$s->legal_forename.$s->legal_surname]));
			$g = factory(App\Model\Guardian::class)->create();
			$g->user()->save(factory(App\User::class)->make(['username' => 'p.'.$g->forename.$g->surname]));
			$s->guardians()->attach($g->id, ['priority' => 1, 'relation' => 'guardian']);
			$s->schools()->attach(App\Model\School::inRandomOrder()->first(), ['arrival_date' => Carbon\Carbon::now()]);
		});
	}
}

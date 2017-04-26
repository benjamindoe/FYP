<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('subject')->insert([
			['name' => 'Maths'],
			['name' => 'English'],
			['name' => 'Science']
		]);
    }
}

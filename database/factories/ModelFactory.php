<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {

	return [
		'username' => $faker->firstName.$faker->lastName,
		'password' => bcrypt('password'),
	];
});

$factory->define(App\Model\Staff::class, function (Faker\Generator $faker) {
	return [
		'forename' => $faker->firstName,
		'surname' => $faker->lastName,
		'role' => 'teacher',
		'school_urn' => App\Model\School::first()->unique_reference_number,
	];
});

$factory->define(App\Model\Guardian::class, function (Faker\Generator $faker) {
	return [
		'title' => $faker->title,
		'forename' => $faker->firstName,
		'surname' => $faker->lastName,
	];
});


$factory->define(App\Model\House::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->company,
		'primary_colour' => $faker->hexcolor,
		'secondary_colour' => $faker->hexcolor,
		'points' => 0
	];
});

$factory->define(App\Model\Student::class, function (Faker\Generator $faker) {
	$dob = null;
	while(!$dob)
	{
		$dob = $faker->dateTimeBetween('-10 years', '-5 years');
		$date = Carbon\Carbon::instance($dob);
		if (!$yearGroup = calculateYearGroup($date))
			$dob = null;
	}
	$upn = new App\UpnFactory(Carbon\Carbon::now());
	$upn->generatePermanent()->save();
	return [
		'legal_forename' => $faker->firstName,
		'legal_surname' => $faker->lastName,
		'dob' => $dob,
		'gender' => 'both',
		'year_group' => $yearGroup['yearGroup'],
		'class_id' => 1,
		'notes' => '',
		'upn' => $upn->getUpn(),
		'house_id' => App\Model\House::inRandomOrder()->first()->id
	];
});


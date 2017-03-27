<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearGroups extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('year_groups', function (Blueprint $table) {
			$table->increments('id');
			$table->string('group')->unique();
			$table->string('keystage');
			$table->timestamps();
		});

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

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('year_groups');
	}
}

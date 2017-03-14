<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAttendanceCodesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance_codes', function (Blueprint $table) {
			$table->char('code', 1)->primary();
			$table->string('description');
			$table->timestamps();
		});

		DB::table('attendance_codes')->insert([
			['code'			=> '/',
			 'description'	=> 'Present at School (AM)'],
			['code'			=> '\\',
			 'description'	=> 'Present at School (PM)'],
			['code'			=> 'L',
			 'description'	=> 'Late arrival before the register has closed'],
			['code'			=> 'B',
			 'description'	=> 'Approved off-site educational activity. Off-site educational activity'],
			['code'			=> 'D',
			 'description'	=> 'Approved off-site educational activity. Dual Registered - at another educational establishment'],
			['code'			=> 'J',
			 'description'	=> 'Approved off-site educational activity. At an interview with prospective employers, or another educational establishment'],
			['code'			=> 'P',
			 'description'	=> 'Approved off-site educational activity. Participating in a supervised sporting activity'],
			['code'			=> 'V',
			 'description'	=> 'Approved off-site educational activity. Educational visit or trip'],
			['code'			=> 'W',
			 'description'	=> 'Approved off-site educational activity. Work Experiance'],
			['code'			=> 'C',
			 'description'	=> 'Authorised Absence. Leave of absence authorised by the school'],
			['code'			=> 'E',
			 'description'	=> 'Authorised Absence. Excluded but no alternative provision made'],
			['code'			=> 'H',
			 'description'	=> 'Authorised Absence. Holiday authorised by the school'],
			['code'			=> 'I',
			 'description'	=> 'Authorised Absence. Illness (Not medical or dental appointments)'],
			['code'			=> 'M',
			 'description'	=> 'Authorised Absence. Medical or dental appointments'],
			['code'			=> 'R',
			 'description'	=> 'Authorised Absence. Religious observance'],
			['code'			=> 'S',
			 'description'	=> 'Authorised Absence. Study leave'],
			['code'			=> 'T',
			 'description'	=> 'Authorised Absence. Gypsy, Roma and Traveller absence'],
			['code'			=> 'G',
			 'description'	=> 'Unauthorised Absence. Holiday not authorised by the school or in excess of the period determined by the head teacher.'],
			['code'			=> 'N',
			 'description'	=> 'Unauthorised Absence. No reason yet provided for absence'],
			['code'			=> 'O',
			 'description'	=> 'Unauthorised Absence. Absent from school without authorisation'],
			['code'			=> 'U',
			 'description'	=> 'Unauthorised Absence. Arrived in school after registration closed'],
			['code'			=> 'X',
			 'description'	=> 'Not required to be in school'],
			['code'			=> 'Y',
			 'description'	=> 'Unable to attend due to exceptional circumstances'],
			['code'			=> 'Z',
			 'description'	=> 'Pupil not on admission register'],
			['code'			=> '#',
			 'description'	=> 'Unauthorised Absence. Arrived in school after registration closed'],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('attendance_codes');
	}
}

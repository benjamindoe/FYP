<?php

use Illuminate\Foundation\Inspiring;
use App\Model\School;
use App\Model\YearGroups;
use App\Model\AttainmentRecord;
use App\Model\AttainmentAverage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('avg-att', function () {
	foreach(YearGroups::all() as $yg) //Needs to be changed to loop through year groups
	{
		$records = AttainmentRecord::select(\DB::raw('ROUND(AVG(grade), 0) AS avg_grade'), 'period', 'subject_id')
			->groupBy('period', 'subject_id')
			->whereHas('student', function ($query) use ($yg) {
				$query->where('year_group', $yg->id);
			})->with('attainmentPeriod')->get();
		foreach($records as $record)
		{
			//new attainment average
			$att = AttainmentAverage::firstOrNew(['period_id' => $record->period, 'year_group' => $yg->id, 'subject_id' => $record->subject_id]);
			$att->avg_grade = $record->avg_grade;
			$att->save();
		}
	}
});
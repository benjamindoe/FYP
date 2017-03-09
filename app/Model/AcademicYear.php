<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'academic_years';

	/**
	 * The primary key of the table
	 *
	 * @var string
	 */
	protected $primaryKey = 'academic_year';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'year_start',
        'year_end',
    ];

	public function school()
	{
		return $this->belongsTo('App\Model\School', 'school_urn', 'unique_reference_number');
	}
}

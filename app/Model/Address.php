<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'address';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * create an address and return it. ->save() not needed.
	 * 
	 * @param  string $addressLines [line 1], [line 2], [line 3], [line 4], [locality], [city], [county], [postcode]
	 * @return App\Model\Address
	 */
	public static function createWithCommaString(string $addressLines)
	{

		$addressLines = explode(', ', $addressLines);
		$address = Address::firstOrCreate([
			'address_line_1' => $addressLines[0],
			'address_line_2' => $addressLines[1],
			'address_line_3' => $addressLines[2],
			'address_line_4' => $addressLines[3],
			'locality'		 => $addressLines[4],
			'city'			 => $addressLines[5],
			'county'		 => $addressLines[6],
			'postcode'		 => $addressLines[7],
		]);
		return $address;
	}
}

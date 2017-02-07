<?php namespace App;

use App\Model\Upn;

class UpnGenerator 
{
	private static $localAuth = 860;
	private static $estNum = 1020;
	private $checkLetter;
	private $upn;
	private $schoolYear;
	private $serial;
	private $isTemp;

	function __construct()
	{
	}
	private static $checkLetters = [
			'A', // 0
			'B', // 1
			'C', // 2
			'D', // 3
			'E', // 4
			'F', // 5
			'G', // 6
			'H', // 7
			'J', // 8
			'K', // 9
			'L', // 10
			'M', // 11
			'N', // 12
			'P', // 13
			'Q', // 14
			'R', // 15
			'T', // 16
			'U', // 17
			'V', // 18
			'W', // 19
			'X', // 20
			'Y', // 21
			'Z', // 22			
	];

	public function generatePermanent($schoolYear)
	{
		$this->upn = '';
		$this->isTemp = false;
		$this->schoolYear = $schoolYear;
		$prevUpn = $this->getPrevUpn();
		$this->serial = empty($prevUpn) ? 1 : $prevUpn->serial_number + 1;
		$this->buildUpn();
		$this->getCheckLetter();
		var_dump($this->upn);
	}

	public function generateTemp($schoolYear)
	{
		$this->upn = '';
		$this->isTemp = true;
		$this->schoolYear = $schoolYear;
		$prevUpn = $this->getPrevUpn();
		if(empty($prevUpn))
		{
			$this->serial = 10;
		} else if($prevUpn->serial_number >= 990)
		{
			$this->serial = $prevUpn->serial_number + 1;
			$last = substr($prevUpn->serial_number, -1);
			$this->serial = inval('01'.$last) + 1;
		} else 
		{
			$this->serial = $prevUpn->serial_number + 10;
		}
		$this->buildUpn();
		$lastDigit = substr($this->upn, -1);
		$this->upn = substr($this->upn, 0, -1);
		$this->getCheckLetter();
		$this->upn .= self::$checkLetters[$lastDigit];
		dd($this->upn);
	}

	private function buildUpn()
	{
		$this->upn .= sprintf('%03d', self::$localAuth) . sprintf('%04d', self::$estNum) . sprintf('%02d', $this->schoolYear) . sprintf('%03d', $this->serial);
	}

	private function getCheckLetter()
	{
		$checkDigit = 0;
		for($i = 0; $i < strlen($this->upn); $i++)
		{
			$checkDigit += intval($this->upn[$i]) * ($i + 2);
		}
		$checkDigit = $checkDigit % count(self::$checkLetters);
		$this->checkLetter = self::$checkLetters[$checkDigit];
		$this->upn = $this->checkLetter . $this->upn;;
	}

	private function getPrevUpn()
	{
		return Upn::previousUpn(self::$localAuth, self::$estNum, $this->schoolYear, $this->isTemp);
	}

	public function save()
	{
		$upn = new Upn;
		$upn->upn = $this->upn;
		$upn->check_letter = $this->checkLetter;
		$upn->la_number = self::$localAuth;
		$upn->establishment_number = self::$estNum;
		$upn->year_code = $this->schoolYear;
		$upn->serial_number = $this->$serial;
		$upn->is_temp = $this->isTemp;

		$upn->save();
	}
}


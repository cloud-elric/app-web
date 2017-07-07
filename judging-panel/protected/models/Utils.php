<?php
class Utils{
	
	/**
	 *
	 * @return number with ordinal suffix
	 *
	 * @param int $number
	 *
	 * @param int $ss Turn super script on/off
	 *
	 * @return string
	 *
	 */
	public static function ordinalSuffix($number, $ss=0)
	{
	
		/*** check for 11, 12, 13 ***/
		if ($number % 100 > 10 && $number %100 < 14)
		{
			$os = 'th';
		}
		/*** check if number is zero ***/
		elseif($number == 0)
		{
			$os = '';
		}
		else
		{
			/*** get the last digit ***/
			$last = substr($number, -1, 1);
	
			switch($last)
			{
				case "1":
					$os = 'st';
					break;
	
				case "2":
					$os = 'nd';
					break;
	
				case "3":
					$os = 'rd';
					break;
	
				default:
					$os = 'th';
			}
		}
	
		/*** add super script ***/
		$os = $ss==0 ? $os : '<sup>'.$os.'</sup>';
	
		/*** return ***/
		return $number.$os;
	}
	
	
}
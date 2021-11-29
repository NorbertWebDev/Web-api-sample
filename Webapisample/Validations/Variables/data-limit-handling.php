<?php
/*
 * Description: Data limit(s) validation(s) handling for variable(s)
 * Author: Kovács Norbert
 * Date: 2020/10/05
 * Version: 1.0
 */

/*
 * Description: To validate and make the handling for the data limit(s) for variable(s) 
 */
Class DataLimitHandler
{
	/*
	 * Description: Define the maximum range for input data except user_id value
	 * Value type(s): Integer
	 */
	private static $iDataRangeMin = 0;
	private static $iDataRangeMax = 11;

	/*
     * Description: Check that the given integer value meets the condition
     * Parameters: $iIntegerValue
     * Value type(s): Integer
     */
	public function checkInsertTestResultLimit($iIntegerValue)
	{
		if($iIntegerValue > self::$iDataRangeMin && $iIntegerValue < self::$iDataRangeMax)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
<?php
/*
 * Description: Data type validation(s) and handling data type(s) for variable(s) 
 * Author: Kovács Norbert
 * Date: 2020/10/05
 * Version: 1.0
 */

/*
 * Description: To validate and make the handling for the data type(s) for variable(s) 
 */
Class DataTypeHandler
{
	/*
     * Description: Value for check integer data type for variable
     * Value type(s): Integer(default null)
     */
	public $iIntegerValue = null;

	/*
     * Description: Value for transformation to integer data type for variable
     * Value type(s): Integer(default null)
     */
	public $vValue = null;

	/*
     * Description: Check that the given value is integer or not
     * Parameters: $iIntegerValue
     * Value type(s): Integer
     */
	public function checkIntegerType($iIntegerValue)
	{
		if(is_int($iIntegerValue) === true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
     * Description: Transform the given value to integer
     * Parameters: $vValue
     * Value type(s): Variable
     */
	public function transformIntegerType($vValue)
	{
		return intval($vValue);
	}
}
?>
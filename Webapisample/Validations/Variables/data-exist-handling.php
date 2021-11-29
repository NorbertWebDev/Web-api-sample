<?php
/*
 * Description: Data existence validation(s) handling for variable(s)
 * Author: Kovács Norbert
 * Date: 2020/10/05
 * Version: 1.0
 */

/*
 * Description: To validate existence and make the handling for variable(s) 
 */
Class DataExistenceHandler
{
	/*
     * Description: Method of request for existence validation for variable
     * Value type(s): String(default null)
     */
	public $sRequestMethod = null;
	
	/*
     * Description: Value for existence validation for variable
     * Value type(s): String(default null)
     */
	public $sValueName = null;
	
	/*
     * Description: Existence validation for the given value for HTTP or HTTPS request(s)
     * Parameters: $sValueName
     * Value type(s): String
     */
	public function existenceValidationRequestValue($sRequestMethod, $sValueName)
	{
		if($sRequestMethod === "GET")
		{
			return isset($_GET[$sValueName]);
		}
		else if($sRequestMethod === "POST")
		{
			return isset($_POST[$sValueName]);
		}
	}
}
?>
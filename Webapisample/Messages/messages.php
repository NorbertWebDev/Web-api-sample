<?php
/*
 * Description: Store messages an organized way
 * Author: Kovács Norbert
 * Date: 2020/10/05
 * Version: 1.0
 */

/*
 * Description: Define all common message texts what could be shown for user(s)
 */
Class CommonMessages
{
	/*
     * Description: Common messages for process(es)
     * Value type(s): String
     */
	public const sProcessError = "An error occured during the process!";
	public const sProcessNotAllowed = "Request cannot be allowed!";
}

/*
 * Description: Define all insert new test result message texts what could be shown for user(s)
 */
Class MessagesInsertTestResult
{
	/*
     * Description: Messages for insert test result process(es)
     * Value type(s): String
     */
	public const sProcessSuccess = "Test result created successfully!";
	public const sProcessValidationDataTypeError = "Value is not integer number!";
	public const sProcessValidationDataRangeError = "Values except user_id must be beetween 0 and 11!";
	public const sProcessValidationValueMissingError = "Missing and the value is not sent!";
}

/*
 * Description: Define all get test results message texts what could be shown for user(s)
 */
Class MessagesGetTestResults
{
	/*
     * Description: Messages for get test results process(es)
     * Value type(s): String
     */
	public const sProcessNoEntries = "Tthere are no test results!";
}
?>
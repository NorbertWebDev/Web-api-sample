<?php
/*
 * Description: Get all test participants who have test results
 * Author: Kovács Norbert
 * Date: 2020/10/05
 * Version: 1.0
 */

/*
 * Description: Include the file what contains all system provided messages
 */
include_once('Messages/messages.php');

/*
 * Description: Create an instance of the common message class to be able to use it
 */	
$oCommonMessages = new CommonMessages();

if($_SERVER['REQUEST_METHOD'] == "GET")
{	
	/*
	 * Description: Include the file what contains all database related methods
	 */
	include_once('Database/database.php');

	/*
	 * Description: Include the file what contains all data value limit validation(s) and handling methods
	 */
	include_once('Validations/Variables/data-exist-handling.php');
	
	/*
	 * Description: Create an instance of the data existence validation(s) handling class to be able to use it
	 */	
	$oDataExistenceHandler = new DataExistenceHandler();

	/*
	 * Description: when a request is made using get method and create an object instance of the data layer
	 */
	$vTestResult = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "result") ? $oDataStorage = new DataStorage() :  "";
		
	$aAllResultItems = array();

	/*
	 * Description: Create an instance of the get test results message classes to be able to use them
	 */	
	$oMessagesGetTestResults = new MessagesGetTestResults();

	/*
	 * Description: Run the get all test participants who have test results process
	 */	
	$allTestResultItems = $oDataStorage->startGetTestResults();

	/*
	 * Description: Loop through all the test results
	 */
	while($aResultItems = $allTestResultItems->fetch_array(MYSQLI_NUM))
	{
		if(mysqli_num_rows($allTestResultItems) !=0)
		{
			$aAllResultItems[] = array("Firstname" => $aResultItems[0], "Middle name" => $aResultItems[1], "Lastname" => $aResultItems[2], "Email" => $aResultItems[3], "Phone" => $aResultItems[4], "Mobile" => $aResultItems[5], "Programming" => $aResultItems[6], "Networking" => $aResultItems[7], "Op_systems" => $aResultItems[8], "Databases" => $aResultItems[9], "Version_control" => $aResultItems[10], "Testing" => $aResultItems[11]);
		}
		else
		{
			$json = array("status" => 0, "error" => $oCommonMessages::sProcessNoEntries);
		}
	}

	/*
	 * Description: Make other responses for the process
	 */	
	if($json.length === 0)
	{
		$json = array("status" => 0, "error" => $oCommonMessages::sProcessError);
	} 
	else
	{
		$json = array("status" => 1, "info" => $aAllResultItems);
	}
}
else{
	$json = array("status" => 0, "Info" => $oCommonMessages::sProcessNotAllowed);
}

// JSON data type will be returned
header('Content-type: application/json');
echo json_encode($json);
?>

<?php
/*
 * Description: Create test result
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

/*
 * Description: when a request is made using post method
 */
if($_SERVER['REQUEST_METHOD'] == "POST")
{	
	/*
	 * Description: Include the file what contains all database related methods
	 */
	include_once('Database/database.php');

	/*
	 * Description: Include the file what contains all data type validation(s) and handling methods
	 */
	include_once('Validations/Variables/data-type-handling.php');
	
	/*
	 * Description: Include the file what contains all data value limit validation(s) and handling methods
	 */
	include_once('Validations/Variables/data-limit-handling.php');

	/*
	 * Description: Include the file what contains all data value limit validation(s) and handling methods
	 */
	include_once('Validations/Variables/data-exist-handling.php');

	/*
	 * Description: Create an instance of the insert test result message class to be able to use it
	 */	
	$oMessagesInsertTestResult = new MessagesInsertTestResult();
	
	/*
	 * Description: Create an instance of the data type validation(s) and handling class to be able to use it
	 */	
	$oDataTypeHandler = new DataTypeHandler();
	
	/*
	 * Description: Create an instance of the data limit(s) validation(s) handling class to be able to use it
	 */	
	$oDataLimitHandler = new DataLimitHandler();

	/*
	 * Description: Create an instance of the data existence validation(s) handling class to be able to use it
	 */	
	$oDataExistenceHandler = new DataExistenceHandler();

	$aValidateState = array();
	$aValidationMessage = array();
		
	/* ValidState
	 * Description: Get all the required data from sent data and  set a valid state
	 * Values: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
     * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
	 */
	$iUserId = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "user_id") ? $aValidateState["user_id"]=1 : $aValidateState["user_id"]=0;
	$iProgramming = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "programming") ? $aValidateState["programming"]=1 : $aValidateState["programming"]=0;
	$iNetworking = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "networking") ? $aValidateState["networking"]=1 : $aValidateState["networking"]=0;
	$iOpSystems = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "op_systems") ? $aValidateState["op_systems"]=1 : $aValidateState["op_systems"]=0;
	$iDatabaseSystems = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "database_systems") ? $aValidateState["database_systems"]=1 : $aValidateState["database_systems"]=0;
	$iVersionControl = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "version_control") ? $aValidateState["version_control"]=1 : $aValidateState["version_control"]=0;
	$iTesting = $oDataExistenceHandler->existenceValidationRequestValue($_SERVER['REQUEST_METHOD'], "testing") ? $aValidateState["testing"]=1 : $aValidateState["testing"]=0;
	
	/*
	 * Description: Validate all the data what was sent with post method
	 */
	if($aValidateState["user_id"] === 1 && $aValidateState["programming"] === 1 && $aValidateState["networking"] === 1 && $aValidateState["op_systems"] === 1 && $aValidateState["database_systems"] === 1 && $aValidateState["version_control"] === 1 && $aValidateState["testing"] === 1)
	{
		/*
		 * Description: Get all the required data from sent data
		 * Values: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
		 * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
		 */
		$iUserIdValidState = $oDataTypeHandler->transformIntegerType($_POST['user_id']);
		$iProgrammingValidState = $oDataTypeHandler->transformIntegerType($_POST['programming']);
		$iNetworkingValidState = $oDataTypeHandler->transformIntegerType($_POST['networking']);
		$iOpSystemsValidState = $oDataTypeHandler->transformIntegerType($_POST['op_systems']);
		$iDatabaseSystemsValidState = $oDataTypeHandler->transformIntegerType($_POST['database_systems']);
		$iVersionControlValidState = $oDataTypeHandler->transformIntegerType($_POST['version_control']);
		$iTestingValidState = $oDataTypeHandler->transformIntegerType($_POST['testing']);
		
		/*
		 * Description: Validate data type(s) for all the data what was sent with the post method
		 */
		if(($oDataTypeHandler->checkIntegerType($iUserIdValidState)) && ($oDataTypeHandler->checkIntegerType($iProgrammingValidState)) && ($oDataTypeHandler->checkIntegerType($iNetworkingValidState)) && ($oDataTypeHandler->checkIntegerType($iOpSystemsValidState)) && ($oDataTypeHandler->checkIntegerType($iDatabaseSystemsValidState)) && ($oDataTypeHandler->checkIntegerType($iVersionControlValidState)) && ($oDataTypeHandler->checkIntegerType($iTestingValidState)))
		{
			if(($oDataLimitHandler->checkInsertTestResultLimit($iProgrammingValidState)) && ($oDataLimitHandler->checkInsertTestResultLimit($iNetworkingValidState)) && ($oDataLimitHandler->checkInsertTestResultLimit($iOpSystemsValidState)) && ($oDataLimitHandler->checkInsertTestResultLimit($iDatabaseSystemsValidState)) && ($oDataLimitHandler->checkInsertTestResultLimit($iVersionControlValidState)) && ($oDataLimitHandler->checkInsertTestResultLimit($iTestingValidState)))
			{
				/*
				 * Description: Create an object instance of the data layer
				 */
				$oDataStorage = new DataStorage();
				
				/*
				 * Description: Run the create test result process
				 * Values: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
				 * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
				 */
				$vResult = $oDataStorage->startCreateTestResult($iUserIdValidState,$iProgrammingValidState,$iNetworkingValidState,$iOpSystemsValidState,$iDatabaseSystemsValidState,$iVersionControlValidState,$iTestingValidState);
				
				/*
				 * Description: Make the response what is depend on the process's state
				 */
				if($vResult === true)
				{
					$json = array("status" => 1, "Success" => $oMessagesInsertTestResult::sProcessSuccess);
				}
				else
				{
					$json = array("status" => 0, "Error" => $oCommonMessages::sProcessError);
				}
			}
			else
			{
				$json = array("status" => 0, "Error" => $oMessagesInsertTestResult::sProcessValidationDataRangeError);
			}
			
		}
		else
		{
			if(!($oDataTypeHandler->checkIntegerType($iUserIdValidState)))
			{
				$aValidationMessage["user_id"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}
			if(!($oDataTypeHandler->checkIntegerType($iProgrammingValidState)))
			{
				$aValidationMessage["programming"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}	
			if(!($oDataTypeHandler->checkIntegerType($iNetworkingValidState)))
			{
				$aValidationMessage["networking"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}	
			if(!($oDataTypeHandler->checkIntegerType($iOpSystemsValidState)))
			{
				$aValidationMessage["op_systems"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}	
			if(!($oDataTypeHandler->checkIntegerType($iDatabaseSystemsValidState)))
			{
				$aValidationMessage["database_systems"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}
			if(!($oDataTypeHandler->checkIntegerType($iVersionControlValidState)))
			{
				$aValidationMessage["version_control"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}
			if(!($oDataTypeHandler->checkIntegerType($iTestingValidState)))
			{
				$aValidationMessage["testing"] = $oMessagesInsertTestResult::sProcessValidationDataTypeError;
			}
		}
	}
	else if($aValidateState["user_id"] === 0)
	{
		$aValidationMessage["user_id"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}
	else if($aValidateState["programming"] ===0)
	{
		$aValidationMessage["programming"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}
	else if($aValidateState["networking"] ===0)
	{
		$aValidationMessage["networking"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}
	else if($aValidateState["op_systems"] === 0)
	{
		$aValidationMessage["op_systems"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}	
	else if($aValidateState["database_systems"] === 0)
	{
		$aValidationMessage["database_systems"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}	
	else if($aValidateState["version_control"] === 0)
	{
		$aValidationMessage["version_control"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}
	else if($aValidateState["testing"] === 0)
	{
		$aValidationMessage["testing"] = $oMessagesInsertTestResult::sProcessValidationValueMissingError;
	}
	
	if(gettype($aValidationMessage) === 'array')
	{
		if(count($aValidationMessage) > 0)
		{
			$json = array("status" => 0, "Error" => $aValidationMessage);
		}
	}
	else
	{
		$json = array("status" => 0, "Error" => $oMessagesInsertTestResult::sProcessSuccess);
	}
}
else{
	$json = array("status" => 0, "Info" => $oCommonMessages::sProcessNotAllowed);
}

// JSON data type will be returned
header('Content-type: application/json');
echo json_encode($json);
?>

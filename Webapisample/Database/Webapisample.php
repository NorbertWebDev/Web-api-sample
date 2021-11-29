<?php
/*
 * Description: Database class and functions what are needed
 * Author: Kovács Norbert
 * Date: 2020/10/05
 * Version: 1.0
 */

/*
 * Description: Store data to a data storage, which is a database for now
 */
Class DataStorage
{
    /*
     * Description: Connection parameters to the data storage
     * Value type(s): String
     */
    private static $sDataHostName = "127.0.0.1";
    private static $sDataHostUsername = "root";
    private static $sDataHostUserPassword = "6Ma788312";
    private static $sDataHostDatabaseName = "webapisample";
    private static $sDataHostPortNumber = '3306';

    /*
     * Description: Store the MySql object for database actions
     * Value type(s): Object
     */
    private static $oDataStorage;
    
	/*
     * Description: Store the data of the get all test results from query 
     * Value type(s): Null or Object
     */
    private static $vGetTestResultsData;
	
	 /*
     * Description: Store the get all results SQL query string
     * Value type(s): Null or String
     */
    private static $vGetTestResultsSQL;
	
    /*
     * Description: Store the insert SQL query string
     * Value type(s): Null or String
     */
    private static $vInsertTestResultSQL;
    
    /*
     * Description: Store messages for the DataStorage class
     * Value type(s): String, String, String
     */
    private static $sConnectionError = "Nem sikerült csatlakozni az adatbázishoz!";
	private static $sGetQueryExecuted = "Sikeres lekérdezés az adatbázisból.";
    private static $sInsertQueryExecuted = "Sikeres rekord létrehozás az adatbázisban.";
    private static $sProcessStop = "Folyamat leállt.";
    
    public function __construct()
    {
        /*
         * Description: Connect to the data storage
         * Parameters: $sDataHostName, $sDataHostUsername, $sDataHostUserPassword, $sDataHostDatabaseName, $sDataHostPortNumber
         * Value type(s): String
        */
        self::$oDataStorage = new mysqli(self::$sDataHostName, self::$sDataHostUsername, self::$sDataHostUserPassword, self::$sDataHostDatabaseName, self::$sDataHostPortNumber);
    }
    
    /*
     * Description: Check that the connection is made
     */
    protected function checkConnection()
    {
        /*
         * Description: Do the step(s) when a connection established or not
         * Parameters: $oDataStorage
         * Value type(s): Object
        */
        if(self::$oDataStorage->connect_error)
        {
            error_log(self::$sConnectionError, 0);
            
            return false;
        }
        else 
        {
            return true;
        }
    }
    
    /*
     * Description: Check and prepare the values for the insert SQL query string
     * Parameters: $sValueToCheck
     * Value type(s): String
     */
    protected function checkSQLValues($sValueToCheck)
    {
        // If it has no value then make it null, but when the opposite the value must be properly prepared for SQL query
        $sValueToCheck = isset($sValueToCheck) ? "'".self::$oDataStorage->real_escape_string(utf8_encode($sValueToCheck))."'" : "NULL";
        
        return $sValueToCheck;
    }
    
	/*
     * Description: Make the get all test results SQL query string
     */
    protected function getTestResultsSQL()
    {   
        // Set the default value
        self::$vGetTestResultsSQL = null;
        
        /*
         * Description: Start to make the SQL query string
         */
        self::$vGetTestResultsSQL = "SELECT * FROM webapisample.get_users_with_result";
    }
	
    /*
     * Description: Make the create test result SQL query string
     * Parameters: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
     * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
     */
    protected function createTestResultSQL($iUser_id,$iProgramming,$iNetworking,$iOpSystems,$iDatabaseSystems,$iVersionControl,$iTesting)
    {   
        // Set the default value
        self::$vInsertTestResultSQL = null;
        
        /*
         * Description: Start to make the create test result SQL query string
         * Parameters: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
		 * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
         */
        self::$vInsertTestResultSQL = "call webapisample.insert_test_result";
        
        self::$vInsertTestResultSQL .= "(".$this->checkSQLValues($iUser_id).",".$this->checkSQLValues($iProgramming).",";
        self::$vInsertTestResultSQL .= $this->checkSQLValues($iNetworking).",".$this->checkSQLValues($iOpSystems).",";
        self::$vInsertTestResultSQL .= $this->checkSQLValues($iDatabaseSystems).",".$this->checkSQLValues($iVersionControl).",";
        self::$vInsertTestResultSQL .= $this->checkSQLValues($iTesting);
        self::$vInsertTestResultSQL .= ")";
    }
    
	/*
     * Description: Run the get all test results SQL query string
     */
    protected function getTestResults()
    {
        /*
         * Description: Do the step(s) after the query is executed
         * Parameters: $oDataStorage, $vInsertTestResultSQL
         * Value type(s): Object, Null or String
         */
        if(self::$vGetTestResultsData = self::$oDataStorage->query(self::$vGetTestResultsSQL) != null)
        {
            error_log(self::$sGetQueryExecuted, 0);
            
			self::$vGetTestResultsData = self::$oDataStorage->query(self::$vGetTestResultsSQL);
			
            return self::$vGetTestResultsData;
        }
        else
        {
            error_log("Hiba: " . self::$vGetTestResultsSQL . "<br>" . self::$oDataStorage->error, 0);
            
            return false;
        }
    }
	
    /*
     * Description: Run the get all test results SQL query string
     */
    protected function createTestResult()
    {
        /*
         * Description: Do the step(s) after the query is executed
         * Parameters: $oDataStorage, $vInsertTestResultSQL
         * Value type(s): Object, Null or String
         */
        if(self::$oDataStorage->query(self::$vInsertTestResultSQL) === TRUE)
        {
            error_log(self::$sInsertQueryExecuted, 0);
            
            return true;
        }
        else
        {
            error_log("Hiba: " . self::$vInsertTestResultSQL . "<br>" . self::$oDataStorage->error, 0);
            
            return false;
        }
    }
   
    /*
     * Description: Start to run the whole get all test results process
     */
    public function startGetTestResults()
    {
        /*
         * Description: Do the step(s) when a connection established or not
        */
        if($this->checkConnection() === true)
        {
            /*
             * Description: Call the SQL query string maker
             */
            $this->getTestResultsSQL();
            
            // Description: Run the SQL query string
            return $this->getTestResults();
        }
        else
        {
            error_log(self::$sProcessStop, 0);
        }
    }
   
    /*
     * Description: Start to run the whole create test result process
      * Parameters: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
	  * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
     */
    public function startCreateTestResult($iUser_id,$iProgramming,$iNetworking,$iOpSystems,$iDatabaseSystems,$iVersionControl,$iTesting)
    {
        /*
         * Description: Do the step(s) when a connection established or not
        */
        if($this->checkConnection() === true)
        {
            /*
             * Description: Call the SQL query string maker
			  * Parameters: $iUser_id, $iProgramming, $iNetworking, $iOpSystems, $iDatabaseSystems, $iVersionControl, $iTesting
			  * Value type(s): Integer, Integer, Integer, Integer, Integer, Integer, Integer
             */
            $this->createTestResultSQL($iUser_id,$iProgramming,$iNetworking,$iOpSystems,$iDatabaseSystems,$iVersionControl,$iTesting);
            
            // Description: Run the SQL query string
            $this->createTestResult();
			
			return true;
        }
        else
        {
            error_log(self::$sProcessStop, 0);
        }
    }
    
    public function __destruct() 
    {
    }
}
?>
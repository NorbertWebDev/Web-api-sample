/*
 * Description: Create test result
 * Author: Kovács Norbert
 * Date: 2020/10/04
 * Version: 1.0
*/


LICENSE:
-------

The software is provided "as is", without warranty of any kind, express or
implied, including but not limited to the warranties of merchantability,
fitness for a particular purpose and noninfringement. in no event shall the
authors or copyright holders be liable for any claim, damages or other
liability, whether in an action of contract, tort or otherwise, arising from,
out of or in connection with the software or the use or other dealings in the
software. Using any of this at your own risk!



// Web api sample //

Description: 		These APIs made to showcase that the test results can be stored in a custom system(must be a compatible PHP environment).
-----------		If you want to use or administrate in a system what can be a CRM or ITSM, or something with a similar purpose this can be
				a solution for you. This is based on MySQL Database, but it can be changed based on your choice. So it can be stored
				multiple way, just the database.php must be changed, or extend and modify it.
					You can get all the user(s) with existing test result(s). This can be done by follow and make the steps, what are 
				described in the Part 3 section. Create a test result can be done with the steps in the Part 4 chapter.
					Enjoy this, but never forget the license!
					

Part 1 - Requirements
---------------------

Apache latest version
Oracle MySQL Database server
Oracle MySQL Workbench or phpMyAdmin
Tool to test this PHP REST API set

Part 2 - Database
-----------------

Import the Webapisample.sql to the Oracle MySQL Database server


Part 3 - Call the result endpoint(result.php)
---------------------------------

1.	Give the url which is depend on the destination where that file is
2.	Set to GET method type
3.	Your url should look like this http://127.0.0.1/Webapisample/result.php?result


Part 4 - Call the insert test result API
----------------------------------------

1.	Give the url which is depend on the destination where that file is
2.	Set to POST method type
3.	Set the data mode to x-www-form-urlencoded
4.	Following url params with values(all of those are integer data type) of course must be given:
	
		*	user_id
		*	programming
		*	networking
		*	op_systems
		*	database_systems
		*	version_control
		*	testing
	
5.	Your url should look like this http://127.0.0.1/Webapisample/insert-test-result.php
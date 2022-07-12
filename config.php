<?php
/*
// mysql_connect("database-host", "username", "password")
$conn = mysql_connect("localhost","root","root") 
			or die("cannot connected");

// mysql_select_db("database-name", "connection-link-identifier")
@mysql_select_db("test",$conn);
*/

/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */

$databaseHost = 'crudapp.cdf0gxv5lsu5.ap-south-1.rds.amazonaws.com';
$databaseName = 'test';
$databaseUsername = 'admincrud';
$databasePassword = 'test123!';
// $databaseHost = 'localhost';
// $databaseName = 'test';
// $databaseUsername = 'root';
// $databasePassword = '';
$custombucket = 'add-cruds';
$customorigin = 'ap-south-1';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
?>

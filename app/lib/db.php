<?php
/**
* Database connection class
*/
class Database
{  
  static function connect($server = DB_SERVER, $db = DB_DATABASE, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD) { 

  	$conection = mysql_connect($server, $username, $password) 
  	or die("The site database appears to be down.");

  	if ($db != "" && !@mysql_select_db($db)) 
  	die("The site database is unavailable.");

  	return $conection; 
  }

}

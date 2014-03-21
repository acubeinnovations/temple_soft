<?php
$dbhostname = "localhost";
$dbusername = "acube123_temple";
$dbpassword = "templesoft789";
$dbname = "acube123_temple_soft";
//establish the connection with the database server
$myconnection = mysql_connect($dbhostname, $dbusername, $dbpassword) or die ("Unable to connect to server" . mysql_error());
//connect to the database
$blnConnected = mysql_select_db ($dbname, $myconnection) or die("Unable to connect to database" . mysql_error());
?>

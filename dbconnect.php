<?php
	$username="root";
	$password="";
	$hostname="localhost";
	$dbh=mysql_pconnect($hostname, $username, $password);
	$Selected = mysql_select_db("stem",$dbh);
?>
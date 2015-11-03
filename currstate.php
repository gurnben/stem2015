<?php
include("dbconnect.php");
$username = "buchanangb";
$result=mysql_query("SELECT USERNAME, state FROM USER WHERE USERNAME = 'buchanangb'");
	while($row=mysql_fetch_array($result))
	{
		$state['state']=$row['state'];
		$state['username']=$row['USERNAME'];
	}
$json = json_encode($state);
echo $json;
?>
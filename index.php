<?php
include("dbconnect.php");
session_start();
if(!isset($_SESSION["username"]))
{
	header('location: login.php');
}
if(isset($_POST['logout']))
{
	session_unset();
	header('location: login.php');
}
$username=$_SESSION["username"];
if(isset($_POST['powerState']))
{
	$state = -1;
	$result=mysql_query("SELECT state FROM USER WHERE USERNAME = '$username'");
	while($row=mysql_fetch_array($result))
	{
		$state=$row['state'];
	}
	if ($state==0)
	{
		$newState = 1;
		$globalState = "Turn Off";
	}
	else
	{
		$newState = 0;
		$globalState = "Turn On";
	}
	mysql_query("UPDATE USER SET state = '$newState' WHERE USERNAME = '$username'");
}
else
{
	$result=mysql_query("SELECT state FROM USER WHERE USERNAME = '$username'");
	while($row=mysql_fetch_array($result))
	{
		$state=$row['state'];
	}
	$globalState="";
	if ($state==0)
	{
		$globalState="Turn On";
	}
	else
	{
		$globalState="Turn Off";
	}
}
?>
	<html>
	<body>
	<form role="form" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
	<button type="submit" name="powerState"><?php echo $globalState;?>
	</button>
	<br>
	<button type="submit" name="logout">Logout
	</button>
	</form>
	</body>
	</html>	
<?php
	include("dbconnect.php");
	if(isset($_POST['submit']))	
	{	
		$username=$_POST['username'];
		$password=$_POST['password'];
		$result=mysql_query("SELECT PASSWORD FROM USER WHERE USERNAME='$username'");
		while($row=mysql_fetch_array($result))
		{
			$old_pass=$row['PASSWORD'];
		}
		if($old_pass==$password)
		{
			echo('logged in');
			session_start();
			$_SESSION["username"] = "$username";
			header('location: index.php');
		}
	}
	?>
<html>
<body>
<form role="form" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
Enter Username:
<br>
<input type="text" name="username">
<br>
Enter Password:
<br>
<input type="password" name="password">
<br>
<button type="sbmit" name="submit">LOGIN
</form>
</body>
</html>
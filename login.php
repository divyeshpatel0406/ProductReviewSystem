<?php
session_start(); 
?>
<html>
<body>
<?php
	// Starting Session
	
	if (empty($_POST['username']) || empty($_POST['psw'])) {
	
	
		echo "<script language='javascript'>"; 
		echo "alert('Username or Password is empty');";
  echo " location='index.html';"; 
  echo "</script>";
	}
	else
	{
	// Define $username and $password
	$username=$_POST['username'];
	$psw=$_POST['psw'];
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect("localhost", "root", "root");
	if (!$con)
  	{
  		die('Could not connect: ' . mysqli_error());
  	}

	// To protect MySQL injection for Security purpose
	$username = stripslashes($username);
	$psw = stripslashes($psw);
	$username = mysqli_real_escape_string($con,$username);
	$psw = mysqli_real_escape_string($con,$psw);
	// Selecting Database
	$db = mysqli_select_db( $con,"productrate");
	// SQL query to fetch information of registerd users and finds user match.
	$query = mysqli_query($con,"SELECT * FROM `users` WHERE `uname` = '$username' AND `psword` = '$psw'");
	$rows = mysqli_num_rows($query);
	if ($rows == 1) {
		#echo '<span> You already log in</span>';
		
	$_SESSION['login_user']=trim($username); // Initializing Session
	echo "<script language='javascript'>"; 
  echo " location='index.html';"; 
  echo "</script>"; 
	include 'loginsession.php';
	} else {
		
		echo "<script language='javascript'>"; 
		echo "alert('Username or Password is invalid');";
  echo " location='index.html';"; 
  echo "</script>"; 
		//echo "1";
	}
	mysqli_close($con); // Closing Connection
	}
?>

</body>
</html>
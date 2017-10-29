<?php
	session_start();
	$id = session_id();

	$username = $_POST["username"];
	$password = $_POST["password"];

	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	mysql_connect("localhost", "root", "");
	mysql_select_db("login1");
	
	if( isset($_SESSION['user_id']) ){
	header("Location: /");
}
	//fetch data from database
	$result = mysql_query("select * from lecturer where username = '$username' and password ='$password'")
			or die("Failed to query database.".mysql_error());
	$row = mysql_fetch_array($result);
	if ($row['username'] == $username && $row['password'] == $password){
		header("location: lecturer_homepage.php");
		//check if the student id and password match with the credential in the database.
	} else {
		header("location: invalid_lecturer.php");
	}

?>

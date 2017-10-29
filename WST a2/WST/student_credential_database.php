<?php
	
	session_start();
	$studentId = $_SESSION['studentId'];

	$studentId = $_POST["studentId"];
	$password = $_POST["password"];

	$studentId = stripcslashes($studentId);
	$password = stripcslashes($password);
	$studentId = mysql_real_escape_string($studentId);
	$password = mysql_real_escape_string($password);

	mysql_connect("localhost", "root", "");
	mysql_select_db("login1");
	
	if( isset($_SESSION['user_id']) ){
	header("Location: /");
}
	//fetch data from database
	$result = mysql_query("select * from student where studentId = '$studentId' and password ='$password'")
			or die("Failed to query database.".mysql_error());
	$row = mysql_fetch_array($result);
	if ($row['studentId'] == $studentId && $row['password'] == $password){
		//check if the student id and password match with the credential in the database.
		header("location: student_record.php");
	} else {
		header("location: invalid_student.php");
	}

?>

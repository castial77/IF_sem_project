<?php

session_start();


if( isset($_SESSION['user_id']) ){
	header("Location: /");
}


	
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'login1';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}

$message = '';

if(!empty($_POST['studentId']) && !empty($_POST['password'])):
	
	// Enter the new user in the database
	$sql = "INSERT INTO student (studentId, password) VALUES (:studentId, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':studentId', $_POST['studentId']);
	$stmt->bindParam(':password', $_POST['password']);

	if( $stmt->execute() ):
		$message = 'Register Succesfully';
	else:
		$message = 'Error Registration account';
	endif;

endif;

?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">

<title>Register Account</title>

<body>

<div> 
  <!-- Navigation -->
  <header> <a href="lecturer_homepage.php">
    <h4>Lecturer</h4>
  </a>
    <nav>
      <ul>
        
		  <li><a href="student_RegisterAccount.php">Registration</a></li>
        <li> 
			<a href="lecturer_logout.php">Log Out</a></li>
      </ul>
    </nav>
  </header>
</div>
  <section>
    <h2>STUDENT'S RECORD REGISTRATION</h2>
  </section>

  <?php if(!empty($message)): ?>
  <p><?= $message ?></p>
	<?php endif; ?>
<br><br>
	
<div align="center">
	<form action="student_RegisterAccount.php" method="POST" >
		
		Enter Student ID    :<br> <input type="text" placeholder="Student ID" name="studentId"><br><br>
		Enter Password      :<br> <input type="password" placeholder="Password" name="password"><br><br>
		Enter Password again:<br><input type="password" placeholder="confirm password" name="confirm_password"><br><br>
		<input type="submit" text"submit" align="middle">

	</form>
	</div>	
	<br>

</body>
</html>




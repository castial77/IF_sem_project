<!DOCTYPE html>
<html>
<head>
<title>HOME</title>
</head>
<body>

  <div>
  
  <form class="login" action="student_record.php" method="post">
    <p class="title">Student Log in</p>
    <input type="text" placeholder="Student ID" name="studentId" autofocus value=
	<?php if(isset($_SESSION['studentId'])){
echo stripslashes($_SESSION['studentId']);} ?>>
    <i class="fa fa-user"></i>
    <input type="password" name="password" placeholder="Password" />
    <i class="fa fa-key"></i>
    <a href="lecturer_login.php">Lecturer? Click here to login.</a>
    <button>
      <span>Log in</span>
    </button>
  </form>
  </div>

  </body>
  </html>
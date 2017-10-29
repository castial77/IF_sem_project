<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">

</head>
<body>
<!-- Main Container -->
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

    <h2>STUDENT'S RECORD ADDING</h2>
  </section>

  	<br><br><br>
  	<div align="center">
  	<form action="student_InsertRecord.php" method="post">
  	
  	Name: <input type="text" name="name">
 	<br>
  	Student ID: <input type="text" name="studentID">
 	<br>
 	Programme Name: <input type="text" name="programmeName">
 	<br>
  	Subject Name: <input type="text" name="subjectName">
 	<br>
 	Subject Code: <input type="text" name="subjectCode">
 	<br>
 	Assignment 1 Mark (10%): <input type="text" name="mark1">
 	<br>
 	Assignment 2 Mark (20%): <input type="text" name="mark2">
 	<br>
 	Mid Semester Mark (20%): <input type="text" name="midMark">
 	<br>
 	Final Exam Mark (50%): <input type="text" name="finalMark">
 	<br><be><br>
 	<input type="submit" value="Submit">
	</form>
	</div>
   
     <br><br><br>
 
</body>
</html>

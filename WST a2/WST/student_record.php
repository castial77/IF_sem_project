<?php

session_start();

?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">

</head>
<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Navigation -->
  <header>
    <h4 class="logo">Student</h4>
  </a>
    <nav>
      <ul>
        <li>&nbsp;</li>
        <li>&nbsp;</li>
        <li> 
			<a href="student_logout.php">Log Out</a></li>
      </ul>
    </nav>
  </header>

    <h2>STUDENT'S RECORD SYSTEM</h2>
  </section>
  <!-- About Section -->
  <br><br><br>
  <?php
	
    $dbhost = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'login1';

	$conn = mysqli_connect($dbhost, $user, $pass);
	
	$selected = mysqli_select_db($conn, 'login1');
	if (!$selected) {
		die ('Cannot use database :'.mysql_error($conn));
	}
	
	if(isset($_POST['studentId'])){
    $studentId = $_POST['studentId'];
}
	
	
	$result = mysqli_query($conn, "SELECT name, studentId, programmeName, subjectName, subjectCode, assignment1Mark, assignment2Mark, midSemesterMark, finalExamMark, totalMarks, grade FROM record WHERE studentId ='$studentId'");

	

		if ($result->num_rows > 0)
{


echo "<table border='1' cellpadding='10'>";

echo "<tr> <th>Name</th>
 <th> Student ID</th> 
 <th>Programme Name</th> 
 <th>Subject Name</th>
 <th>Subject Code</th>
 <th>Assignment 1 Mark (10%)</th>
 <th>Assignment 2 Mark (20%)</th> 
 <th>Mid Semester Mark (20%)</th>
 <th>Final Exam Mark (50%)</th> 
 <th>Total Mark (100%)</th>
 <th>Grade</th></tr>";



// loop through results of database query, displaying them in the table

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->name . "</td>";
echo "<td>" . $row->studentId . "</td>";
	echo "<td>" . $row->programmeName . "</td>";
	echo "<td>" . $row->subjectName . "</td>";
	echo "<td>" . $row->subjectCode . "</td>";
	echo "<td>" . $row->assignment1Mark . "</td>";
	echo "<td>" . $row->assignment2Mark . "</td>";
	echo "<td>" . $row->midSemesterMark . "</td>";
	echo "<td>" . $row->finalExamMark . "</td>";
	echo "<td>" . $row->totalMarks . "</td>";
	echo "<td>" . $row->grade . "</td>";

echo "</tr>";
}

echo "</table>";
}
	 ?>
<br><br><br>
  
</body>
</html>

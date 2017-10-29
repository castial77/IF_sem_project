<?php

session_start();
$id = session_id();

?>


<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Student's Record</title>
</head>
<body>
<!-- Main Container -->
<div class="container"> 
  <!-- Navigation -->
  <header> <a href="lecturer_homepage.php">
    <h4 class="logo">Lecturer</h4>
  </a>
    <nav>
      <ul>
        
		  <li><a href="student_RegisterAccount.php">Registration</a></li>
        <li> 
			<a href="lecturer_logout.php">Log Out</a></li>
      </ul>
    </nav>
  </header>

    <h2>STUDENT'S RECORD</h2>
  </section>
  <!-- About Section -->
  <br><br><br>
  
 <?php

// server info
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'login1';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

	
   if ($result = $mysqli->query("SELECT * FROM record"))
{

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
 <th>Grade</th>
 <th></th> <th></th></tr>";



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
echo "<td><a href='student_EditRecord.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a href='student_DeleteRecord.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>

<p><a href="student_AddRecord.php">Add a new record</a></p>

</body>
</html>

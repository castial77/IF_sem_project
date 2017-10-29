
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "login1");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$name = $_POST['name'];
$studentID = $_POST['studentID'];
$programmeName = $_POST['programmeName'];
$subjectName = $_POST['subjectName'];
$subjectCode = $_POST['subjectCode'];
$mark1 = $_POST['mark1'];
$mark2 = $_POST['mark2'];
$midMark = $_POST['midMark'];
$finalMark = $_POST['finalMark'];
$totalMarks = $_POST['mark1'] + $_POST['mark2'] + $_POST['midMark'] + $_POST['finalMark'];

if ($totalMarks < "40"){
	$grade = "F";
}
else if ($totalMarks > "39" && $totalMarks < "50"){
	$grade = "D";
}
else if ($totalMarks > "50" && $totalMarks < "59"){
	$grade = "C";
}
else if ($totalMarks > "59" && $totalMarks < "80"){
	$grade = "B";
}
else
	$grade = "A";
$finalGrade = $grade;
 
// attempt insert query execution
$sql = "INSERT INTO record (name, studentId, programmeName, subjectName, subjectCode, assignment1Mark, assignment2Mark, midSemesterMark, finalExamMark, totalMarks, grade) VALUES ('$name', '$studentID', '$programmeName', '$subjectName', '$subjectCode', '$mark1', '$mark2', '$midMark', '$finalMark', '$totalMarks', '$finalGrade')";

if(mysqli_query($link, $sql)){
    header("location: lecturer_homepage.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>

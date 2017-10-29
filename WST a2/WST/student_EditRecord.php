<?php
// including the database connection file
$databaseHost = 'localhost';
$databaseName = 'login1';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name = $_POST['name'];
    $studentId = $_POST['studentId'];
    $programmeName = $_POST['programmeName'];
	$subjectName = $_POST['subjectName'];   
	$subjectCode = $_POST['subjectCode'];   
	$assignment1Mark = $_POST['assignment1Mark'];   
	$assignment2Mark = $_POST['assignment2Mark'];   
	$midSemesterMark = $_POST['midSemesterMark'];   
	$finalExamMark = $_POST['finalExamMark']; 
	$totalMarks = $_POST['assignment1Mark'] + $_POST['assignment2Mark'] + $_POST['midSemesterMark'] + $_POST['finalExamMark'];
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
    
    // checking empty fields
    if(empty($name) || empty($studentId) || empty($programmeName) || empty($subjectName) || empty($subjectCode) || empty($assignment1Mark) || empty($assignment2Mark) || empty($midSemesterMark) || empty($finalExamMark)) {            
        
		if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($studentId)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
		
        if(empty($programmeName)) {
            echo "<font color='red'>Programme Name field is empty.</font><br/>";
        }
		
        if(empty($subjectName)) {
            echo "<font color='red'>Subject Name field is empty.</font><br/>";
        }
		
		if(empty($subjectCode)) {
            echo "<font color='red'>Subject Code field is empty.</font><br/>";
        }
		
		if(empty($assignment1Mark)) {
            echo "<font color='red'>Assignment 1 Mark field is empty.</font><br/>";
        }
		
		if(empty($assignment2Mark)) {
            echo "<font color='red'>Assignment 2 Mark field is empty.</font><br/>";
        }
		
		if(empty($midSemesterMark)) {
            echo "<font color='red'>Mid Semester Mark field is empty.</font><br/>";
        }
		
		if(empty($finalExamMark)) {
            echo "<font color='red'>Final Exam Mark is empty.</font><br/>";
        }
		
    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE record SET name='$name', studentId='$studentId', programmeName='$programmeName', subjectName='$subjectName', subjectCode='$subjectCode', assignment1Mark='$assignment1Mark', assignment2Mark='$assignment2Mark', midSemesterMark='$midSemesterMark', finalExamMark='$finalExamMark', totalMarks='$totalMarks', grade='$grade' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: lecturer_homepage.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM record WHERE id=$id");

if (!$result) { 
    die('Invalid query: ' . mysql_error());
} 
while($res = mysqli_fetch_array($result))
{
    $name = $res['name'];
    $studentId = $res['studentId'];
    $programmeName = $res['programmeName'];
	$subjectName = $res['subjectName'];
	$subjectCode = $res['subjectCode'];
	$assignment1Mark = $res['assignment1Mark'];
	$assignment2Mark = $res['assignment2Mark'];
	$midSemesterMark = $res['midSemesterMark'];
	$finalExamMark = $res['finalExamMark'];
	$totalMarks = $res['assignment1Mark'] + $res['assignment2Mark'] + $res['midSemesterMark'] + $res['finalExamMark'];
}
?>
<html>
<head>    
    <title>Edit Data</title>
    <meta charset="UTF-8">

</head>
 
<body>
   
   <!-- Main Container -->
<div> 
  <!-- Navigation -->
  <header> <a href="student_record.php">
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

    <h2>STUDENT'S RECORD EDIT</h2>
  </section>
    <br><br><br>
    <form name="form1" method="post" action="student_EditRecord.php">
        <table border="0" align="center">
            <tr> 
                <td>Name:</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Student Id:</td>
                <td><input type="text" name="studentId" value="<?php echo $studentId;?>"></td>
            </tr>
            <tr> 
                <td>Programme Name:</td>
                <td><input type="text" name="programmeName" value="<?php echo $programmeName;?>"></td>
            </tr>
            <tr>
               <td>Subject Name:</td>
                <td><input type="text" name="subjectName" value="<?php echo $subjectName;?>"></td>
            </tr>
            <tr>
               <td>Subject Code:</td>
                <td><input type="text" name="subjectCode" value="<?php echo $subjectCode;?>"></td>
            </tr>
            <tr>
               <td>Assignment 1 Mark (10%):</td>
                <td><input type="text" name="assignment1Mark" value="<?php echo $assignment1Mark;?>"></td>
            </tr>
            <tr>
               <td>Assignment 2 Mark (20%)</td>
                <td><input type="text" name="assignment2Mark" value="<?php echo $assignment2Mark;?>"></td>
            </tr>
            <tr>
               <td>Mid Semester Mark (20%)</td>
                <td><input type="text" name="midSemesterMark" value="<?php echo $midSemesterMark;?>"></td>
            </tr>
            <tr>
               <td>Final Exam Mark (50%)</td>
                <td><input type="text" name="finalExamMark" value="<?php echo $finalExamMark;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
    <br><br><br>    
	</div>
</body>
</html>

<?php
session_start();
$studentId = $_SESSION['studentId'];
$topicId = $_SESSION['topicId'];

if (isset($_POST['submit'])) {

	require"../../includes/db.inc.php";

		$date = $_POST['date']; 
		$AssignmentId = $_POST['AssId'];  
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
		$fileType = $_FILES['file']['type'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$error = $_FILES['file']['error'];
        $fileEX = explode('.', $name);
        $fileActualExt = strtolower(end($fileEX));
        $maxSize = 1024 * 1024 * 20;
        $accepted = array("pdf","doc");
        $dir = "../../uploads/";


    	if (!$error === 0) {
        	header("Location:../student_topic_material.php?topicId=$topicId&error=File Upload Error Please Try Again");
            exit();
        }
		else if ($size > $maxSize) {
			
			header("Location:../student_topic_material.php?topicId=$topicId&error=File is to large");
            exit();
		}
		else if (!in_array($fileActualExt,$accepted)){
		   header("Location:../student_topic_material.php?topicId=$topicId&error=Unaccepted File accepted Files are PDF,DOC");
           exit();
		}
		else{

			$sql = "INSERT INTO answer (assignmentId,studentId,answer,submit_date) VALUES (?,?,?,?)";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql)){
               header("Location:../student_topic_material.php?topicId=$topicId&error=Error please try again");
               exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"ssss",$AssignmentId,$studentId,$name,$date);
				mysqli_execute($stmt);
			}
			move_uploaded_file($tmp_name,$dir.$name);
			
		}
		mysqli_stmt_close($stmt);
	    mysqli_close($conn);
	    header("Location:../student_topic_material.php?topicId=$topicId&success=file uploaded successfully");
        exit();		
	
}
else{
	header("Location:../index.php");
    exit();
}
<?php
session_start();
$courseCode = $_SESSION['courseCode'];
require "../../includes/db.inc.php";

if (isset($_POST['create_topic'])) {
	
	$topicName = $_POST['topicName'];
    $date = $_POST['date'];

	if (empty($topicName)) {
		header("Location:../topic.php?error=Name field cannot be empty");
		exit();
	}
    else{
    	$sql = "INSERT INTO topic (courseCode,topicName,Date) VALUES (?,?,?)";
    	$stmt = mysqli_stmt_init($conn);
    	if (!mysqli_stmt_prepare($stmt,$sql)) {
    		header("Location:../topic.php?error=error please try again");
    		exit();
    	}
    	else{
    		mysqli_stmt_bind_param($stmt,"sss",$courseCode,$topicName,$date);
    		mysqli_stmt_execute($stmt);
    		header("Location:../course_material.php?courseCode=$courseCode&success=topic created successfully");
    		exit();
    	}
    }
    mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else{
	header("Location:../index.php");
    exit();
}
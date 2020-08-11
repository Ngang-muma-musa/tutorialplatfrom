<?php
require "../../includes/db.inc.php";
if (isset($_POST['submit'])) {
	$mark = $_POST['mark'];
    $ansId = $_POST['ansId'];
     $AssId = $_POST['AssId'];
     $status = "MARKED";
     // die($ansId);
     $sql = "UPDATE answer SET mark=?,status=? WHERE ansId=?";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt,$sql)) {
     	header("Location:../tutorials.php?id=$AssId&error=Error pleaase try again");
     	exit();
     }
     else{
     	mysqli_stmt_bind_param($stmt,"sss",$mark,$status,$ansId);
     	mysqli_execute($stmt);
     	header("Location:../tutorials.php?id=$AssId&success=Answer marked successfully");
     	exit();
     }
}
elseif (isset($_POST['update'])) {
   
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
            header("Location:../tutorials.php?id=$AssignmentId&error=File Upload Error Please Try Again");
            exit();
        }
        else if ($size > $maxSize) {
            
            header("Location:../tutorials.php?id=$AssignmentId&Error=File is to large");
            exit();
        }
        else if (!in_array($fileActualExt,$accepted)){
           header("Location:../tutorials.php?id=$AssignmentId&error=Unaccepted File accepted Files are PDF,DOC");
           exit();
        }
        else{

            $sql = "UPDATE assignment SET correction=? WHERE assignmentId=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
               header("Location:../tutorials.php?id=$AssignmentId&error=Error please try again");
               exit();
            }
            else{
                mysqli_stmt_bind_param($stmt,"ss",$name,$AssignmentId);
                mysqli_execute($stmt);
            }
            move_uploaded_file($tmp_name,$dir.$name);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location:../tutorials.php?id=$AssignmentId&success=updated  successfully");
        exit();
}
else{
	header("Location:../index,php");
    exit();
}
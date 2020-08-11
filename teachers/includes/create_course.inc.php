<?php
session_start();
echo $teacherId = $_SESSION['teacherId'];

if (isset($_POST['create_course'])) {
	
	require "../../includes/db.inc.php";

	$courseCode = $_POST['courseCode'];
	$courseTitle = $_POST['courseTitle'];
	$creditValue = $_POST['creditValue'];

	if(strlen($courseCode)<6 || strlen($courseCode)>6 ){	
        header("Location:../teachers.php? error=Coursecode to short atleast 6 charecters");
	    exit();
	}
	elseif(strlen($courseCode)==6){
        
        $departmentCode = substr($courseCode,0,3);
        $numberPart = substr($courseCode,3,5);
        if (!preg_match("/[0-9]/",$numberPart)) {
        	header("Location:../teachers.php? error=number code not correct");
	        exit();
        }
        if(!preg_match("/[a-zA-Z]/",$departmentCode)){
        	header("Location:../teachers.php? error=Department code not correct");
	        exit();
        }
        else{
        	$code = strtoupper($departmentCode).$numberPart;
        }
	}


	$sql = "SELECT * FROM course WHERE courseCode = ? OR courseTitle = ?";
	$stmt  = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location:../teachers.php?error=An Error occured please try again");
		exit();
	}
    else{
    	mysqli_stmt_bind_param($stmt,"ss",$code,$courseTitle);
    	mysqli_stmt_execute($stmt);
    	mysqli_stmt_store_result($stmt);
    	if (mysqli_stmt_num_rows($stmt)>0) {
    		header("Location:../teachers.php?error=credentials already exist");
    		exit();
    	}
    	else{

    		$sql2 = "INSERT INTO course (courseCode,courseTitle,creditValue,teacherId) VALUES(?,?,?,?)";
    		$stmt2 = mysqli_stmt_init($conn);
    		if (!mysqli_stmt_prepare($stmt2,$sql2)) {
    			header("Location:../teachers.php?error=An Error occured please try again");
		        exit();
    		}
    		else{
    			mysqli_stmt_bind_param($stmt2,"ssss",$code,$courseTitle,$creditValue,$teacherId);
    			mysqli_execute($stmt2);
    			header("Location:../teachers.php?success=Course created successfully");
		        exit();
    		}
    	}
    }
    mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else{
	header("Location:../index.php");
    exit();
}
<?php
session_start();

$studentId = $_SESSION['studentId'];

if (isset($_POST['register_course'])) {

	require "../../includes/db.inc.php";

	$courseCode = $_POST['courseCode'];

    if(strlen($courseCode)<6 || strlen($courseCode)>6 ){
        header("Location:../students.php? error=Coursecode to short atleast 6 charecters");
	    exit();
	}
	elseif(strlen($courseCode)==6){
        
        $departmentCode = substr($courseCode,0,3);
        $numberPart = substr($courseCode,3,5);
        if (!preg_match("/[0-9]/",$numberPart)) {
        	header("Location:../students.php? error=number code not correct");
	        exit();
        }
        if(!preg_match("/[a-zA-Z]/",$departmentCode)){
        	header("Location:../students.php? error=Department code not correct");
	        exit();
        }
        else{
        	$code = strtoupper($departmentCode).$numberPart;
            // die($code);
        	$sql = "SELECT * FROM course WHERE courseCode = ?";
        	$stmt = mysqli_stmt_init($conn);
        	if (!mysqli_stmt_prepare($stmt,$sql)) {
        		header("Location:../students.php? error=Error please try again");
	            exit();
        	}
        	else{
                mysqli_stmt_bind_param($stmt,"s",$code);
                mysqli_execute($stmt);
                mysqli_stmt_store_result($stmt);
			    $resultcheck = mysqli_stmt_num_rows($stmt);
			    if ($resultcheck==0) {
			    	header("Location:../students.php?error=course doesnt exist");
	                exit();
			    }
			    else{
			    	$sql2 = "INSERT INTO register (courseCode,studentId) VALUES(?,?)";
			    	$stmt2 = mysqli_stmt_init($conn);
			    	if (!mysqli_stmt_prepare($stmt2,$sql2)) {
			    		header("Location:../students.php?error=sql_error");
	                    exit();
			    	}
			    	else{
			    		mysqli_stmt_bind_param($stmt2,"ss",$code,$studentId);
			    		mysqli_execute($stmt2);	
			    		header("Location:../students.php?success=registration successfull");
	                    exit();
			    	}
			    }
        	}
        }
	}
	mysqli_stmt_close($stmt);
	mysqli_stmt_close($stmt2);
	mysqli_close($conn);
}
else{
	header("Location:../index.php");
    exit();
}
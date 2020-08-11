<?php

if (isset($_POST['login'])) {
	
	require "../../includes/db.inc.php";

	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		header("Location:../index.php? error=Invalid Email");
	    exit();
    }
    else{
    	$sql = "SELECT * FROM teachers WHERE email = ?";
    	$stmt = mysqli_stmt_init($conn);
    	if (!mysqli_stmt_prepare($stmt,$sql)) {
    		header("Location:../index.php?error=Login Failed");
		    exit();
    	}
    	else{
    		mysqli_stmt_bind_param($stmt,"s",$email);
    		mysqli_execute($stmt);
    		$result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)==0){
            header("Location:../index.php?error=Try again or register");
            exit();
            }
    		while ($row = mysqli_fetch_assoc($result)) {
    			$passwordCheck = password_verify($pwd,$row['password']);
    			if ($passwordCheck == false) {
    				header("Location:../index.php?error=Incorrect Password");
		            exit();
    			}
    			elseif($passwordCheck == true){
                    session_start();
                    $_SESSION['teacherId'] = $row['teachersId'];
                    $_SESSION['email'] = $row['email'];
                    header("Location:../teachers.php");
		            exit();
    			}
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

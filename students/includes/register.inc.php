<?php
if (isset($_POST['register'])) {
	

	require "../../includes/db.inc.php";

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$pwd2 = $_POST['pwd2'];

	if (!filter_var($email,FILTER_VALIDATE_EMAIL)&&!preg_match("/[a-zA-Z0-9]/",$firstName)&&!preg_match("/[a-zA-Z0-9]/",$lastName)) {
		header("Location:../index.php? error=Invalid Fields");
	    exit();
	}
	elseif (!preg_match("/[a-zA-Z0-9]/",$firstName)) {
		header("Location:../index.php? error=Invalid firstName");
	    exit();
	}
	elseif (!preg_match("/[a-zA-Z0-9]/",$lastName)) {
		header("Location:../index.php? error=Invalid lastName");
	    exit();
	}
	elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		header("Location:../index.php? error=Invalid Email");
	    exit();
	}
	elseif(strlen($pwd)<6){
        
        header("Location:../index.php? error=password to short atleast 6 charecters");
	    exit();
	}
		elseif(!preg_match("/[0-9]/",$pwd)){
       header("Location:../index.php? error=password must include atleast one number");
	    exit();
	}
	elseif(!preg_match("/[a-zA-Z]/",$pwd)){
       header("Location:../index.php? error=password must include atleast one letter");
	    exit();
	}
	elseif ($pwd !== $pwd2) {
		header("Location:../index.php? error=passwords dont match");
	    exit();
	}
	else{
		$sql = "SELECT email FROM students WHERE email = ?";
		$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
    		header("Location:../index.php?error=Email not available");
            exit();
        }
        else{
        	mysqli_stmt_bind_param($stmt,"s",$email);
			mysqli_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultcheck = mysqli_stmt_num_rows($stmt);
		    if ($resultcheck > 0) {
				header("Location:../index.php?error=email already exist");
		        exit();
		    }
		    else{
		    	$sql2 = "INSERT INTO students (firstName,lastName,email,password) VALUES (?,?,?,?)";
				$stmt2 = mysqli_stmt_init($conn);
			    if (!mysqli_stmt_prepare($stmt2,$sql2)) {
					header("Location:../index.php?error=Error please try again");
				    exit();
				}
				else{
					$hashedpassword = password_hash($pwd, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt2,"ssss",$firstName,$lastName,$email,$hashedpassword);
					mysqli_stmt_execute($stmt2);
					header("Location:../index.php?signup=SignUp Successful");
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
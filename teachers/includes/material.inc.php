<?php
if (isset($_POST['submit'])) {
	
	

	require"../../includes/db.inc.php";

		$title = $_POST['title'];
		$date = $_POST['date']; 
		$topicId = $_POST['topicId'];  
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
        	header("Location:../topic_material.php?topicId=$topicId&error=File Upload Error Please Try Again");
            exit();
        }
		else if ($size > $maxSize) {
			
			header("Location:../topic_material.php?topicId=$topicId&Error=File is to large");
            exit();
		}
		else if (!in_array($fileActualExt,$accepted)){
		   header("Location:../topic_material.php?error=Unaccepted File accepted Files are PDF,DOC");
           exit();
		}
		else{
			$sql = "INSERT INTO topiccontent (topicId,title,content,submit_date) VALUES (?,?,?,?)";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql)){
               header("Location:../topic_material.php?topicId=$topicId&error=Error please try again");
               exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"ssss",$topicId,$title,$name,$date);
				mysqli_execute($stmt);
			}
			move_uploaded_file($tmp_name,$dir.$name);
			
		}
		mysqli_stmt_close($stmt);
	    mysqli_close($conn);
	    header("Location:../topic_material.php?topicId=$topicId&success=file uploaded successfully");
        exit();		
	
}
else{
	header("Location:../index.php");
    exit();
}
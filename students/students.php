<?php
session_start();
$studentId = $_SESSION['studentId'];
$email = $_SESSION['email'];
if (!isset($email)&&!isset($studentId )) {
	header("Location:index.php");
	exit();
}
else {
     require"../includes/db.inc.php";	
     $sql = "SELECT * FROM register WHERE studentId = $studentId";
     $result = mysqli_query($conn,$sql);

	?>
	<!DOCTYPE html>
<html>
<head>
	 <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Students</title>
	<style type="text/css">
		.btn{
			width: 100%;
		}
	</style>
</head>
<body>
	<?php
     include"student_nav.php";
	?>

  	<div class="container ">
  		<div class="row">
  			<?php
               while ($row = mysqli_fetch_assoc($result)) {
               	$courseCode = $row['courseCode'];

               	$sql2 = "SELECT * FROM course WHERE courseCode = '$courseCode'";
               	$result2 = mysqli_query($conn,$sql2);
               	while ($rows=mysqli_fetch_assoc($result2)) {
               		$courseCode = $rows['courseCode'];
	               	$courseTitle = $rows['courseTitle'];
	               	$creditValue = $rows['creditValue'];
	               	$teacherId = $rows['teacherId'];
	               	?>
                        <div class="col s12 m4 l4">
				  			<div class="card 69f0ae green accent-2">
				  				<div class="card-content">
				  				<h4 class="center-align teal-text"><?php echo $courseCode; ?></h4>
				  				<h4 class="white-text center-align"><?php echo $courseTitle; ?></h4>
				  				<?php 
                             	$sql3 = "SELECT firstName,lastName FROM teachers WHERE teachersId= $teacherId";
       	                        $result3 = mysqli_query($conn,$sql3);
       	                        while ($roww = mysqli_fetch_assoc($result3)) {
       	                        	$firstName = $roww['firstName'];
       	                        	$lastName = $roww['lastName'];
       	                        	?>
       	                        	<h5 class="white-text center-align"> <span class="teal-text">LECTURER</span><br><?php echo $firstName." ".$lastName; ?></h5>
       	                        	<?php
       	                        }
				  				?>
				  				<h5 class="teal-text center-align">Credit Value:<?php echo $creditValue; ?></h5>
								    <p><a class="btn black lighten-1 z-depth-1 white-text" href="student_course_material.php?courseCode=<?php echo($courseCode);?>">START HERE </a></p>
				  				</div>
				  			</div>
			  			</div>
	               	<?php
                  
	               	}

               }
                  if (!isset($courseCode)) {
                     ?>
                      <div class="info" style=" background-color:rgba(0,0,0,0.5);  padding: 20px;">
                          <h4 class="center-align blue-text">Register A Course To Continue</h4>
                      </div>
                     <?php
                   }
  			?>
  		</div>
  	</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){  
   
      $('.modal').modal();
       $('.sidenav').sidenav();
  	});


  </script>
</body>
</html>
	<?php
}
?>

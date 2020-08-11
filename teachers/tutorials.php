<?php
require"../includes/db.inc.php";
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
    $sql3 = "SELECT mark FROM assignment WHERE assignmentId = $id";
	$result3 = mysqli_query($conn,$sql3);
	while ($row = mysqli_fetch_assoc($result3)) {
		$AssMark = $row['mark'];
		$avmark = $AssMark/2;
	}

	$sql = "SELECT * FROM assignment WHERE assignmentId = $id";
	$result = mysqli_query($conn,$sql);

	$sql2 = "SELECT * FROM answer WHERE assignmentId = $id";
	$result2 = mysqli_query($conn,$sql2);
    
	while ($row = mysqli_fetch_assoc($result)) {
		$title = $row['title'];
	}
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
	<title>Tutorials</title>
</head>
<body>
<?php
 include"nav.php";
?>
<?php
     if (isset($_GET['error'])) {
     	$error = $_GET['error'];
     	?>
     	<h4 class="center-align red-text"><?php echo $error; ?></h4>
     	<?php
     }
     elseif(isset($_GET['success'])){
     	$success = $_GET['success'];
       ?>
     	<h4 class="center-align blue-text"><?php echo $success; ?></h4>
     	<?php
     }
	?>

<div class="container">
	<div class="info">
	<h4 class="center-align"><?php echo($title);?></h4><hr><br>
	<div class="material">
		<a href="view_material.php?id=<?php echo($id);?>&status=tutorial" class="btn ">View Tutorial</a>
		<a href="#modal3" class="modal-trigger btn">Upload Answer</a>
	</div>
	<h5>Students Answers</h5>
			<div id="test1" class="col s12"><br>
			  <ul class="collection">
			  	<?php
                 while ($row = mysqli_fetch_assoc($result2)) {
                 	$studentId = $row['studentId'];
                 	$date = $row['submit_date'];
                 	$ansId = $row['ansId'];
                 	$status = $row['status'];
                 	$mark = $row['mark'];
                 	?>
                 <li class="collection-item avatar">
			      <i class="material-icons circle green">folder</i>
			      <span class="title">
			      	<?php
                     $sql3 = "SELECT firstName,lastName FROM students WHERE studentId = $studentId";
                 	$result3 = mysqli_query($conn,$sql3);
                 	while ($rows = mysqli_fetch_assoc($result3)) {
                 		$firstName = $rows['firstName'];
                 		$lastName = $rows['lastName'];
                 		echo $firstName." ".$lastName;	
                 	}
			      	?>
			      </span>
					<p><?php echo $date;?><br><span class="blue-text"><?php if (isset($status)){echo $status;};?>
						<span>
					<?php
					if($mark>=$avmark ){
					  ?>
					  <span class="green-text"><?php echo $mark."/".$AssMark ?></span>
					  <?php
					}
					elseif ($mark<$avmark) {
						?>
						<span class="red-text"><?php echo $mark."/".$AssMark ?></span>
						<?php
					}
					else{
						?>
						<span ><?php echo"NO score yet"; ?></span>
						<?php
					}

					?>

	               </p>	  
			      <a href="assignment_view.php?ansId=<?php echo($ansId);?>&AssId=<?php echo($id);?>" class="btn black secondary-content">view</a>
			    </li>

			    <?php	
                 }

                 if (!isset($studentId)) {
                 	?>
                 	<li class="center-align blue-text"><?php echo "No student Has submited yet"; ?></li>
                 	<?php
                 }
			  	?>
			  </ul>	
	    </div>
</div>
<div id="modal3" class="modal" style="padding: 20px;">
	<h4 class="center-align">Upload Answer</h4>
	<form method="post" action="includes/assignment_view.inc.php" enctype="multipart/form-data">
		  <div class="file-field input-field">
		      <div class="btn">
		        <span>Upload PDF</span>
		        <input type="file"  name="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
          </div>
           <div class="input-field" style="display: none;">
			<i class="material-icons prefix">create</i>
			<input type="text" name="AssId"  value="<?php echo $id;?>" required>
			<label  for="title">AssignmemtId</label>
		  </div>
          <button type="submit" name="update" class="btn waves-effect black white-text waves-light" style="width: 100%;">SUBMIT</button>
	</form>
</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){  

      $('.tabs').tabs();

      $('.modal').modal();
       $('.sidenav').sidenav();
  	});
</script>
</body>
</html>
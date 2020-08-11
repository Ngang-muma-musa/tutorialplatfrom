<?php
session_start();
$studentId = $_SESSION['studentId'];
$email = $_SESSION['email'];
if (!isset($email)&&!isset($studentId )) {
	header("Location:index.php");
	exit();
}
else{

	require"../includes/db.inc.php";
    if (isset($_GET['topicId'])) {
		$topicId = $_GET['topicId'];
	}
// die($topicId);
	$_SESSION['topicId'] = $topicId; 
	$sql = "SELECT * FROM topic WHERE topicId = $topicId";
	$result = mysqli_query($conn,$sql);

	$sql2 = "SELECT * FROM topiccontent WHERE topicId=$topicId";
	$result2 = mysqli_query($conn,$sql2);

	$sql3 = "SELECT * FROM assignment WHERE topicId=$topicId";
	$result3 = mysqli_query($conn,$sql3);

	while ($row = mysqli_fetch_assoc($result)) {
		$title = $row['topicName'];
		$courseCode = $row['courseCode'];
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
	<title>Topic Material</title>
</head>
<body>
	<?php
     include"student_nav.php";
	?>
	
	<div class="container">
		<div class="info">
			<h4 class="center-align"><?php echo $title; ?><small><?php echo $courseCode; ?></small> </h4>
			<!-- <h5 class="left-align">Topics</h5> -->
		</div>
		<hr>
		<div class="col s12 m12 l12">
		  <ul class="tabs">
	        <li class="tab col s6"><a class="active" href="#test1">ALL Materials</a></li>
	        <li class="tab col s6"><a  href="#test2">ALL Tutorials</a></li>
	      </ul>
		</div>
		<div id="test1" class="col s12"><br>
			  <ul class="collection">
			    <?php
                   while ($row = mysqli_fetch_assoc($result2)) {
                   	$title = $row['title'];
                   	$date = $row['submit_date'];
                   	$id = $row['contentId'];
                   	?>
                   	<li class="collection-item avatar">
				      <i class="material-icons circle green">folder</i>
				      <span class="title"><?php echo $title; ?></span>
				        <p><?php echo $date; ?></p>	  
				      <a href="student_view_course_material.php?id=<?php echo($id);?>" class="btn black secondary-content">view</a>
				    </li>
                   	<?php
                   }

			    ?>
			  </ul>	
	    </div>
	    	<div id="test2" class="col s12"><br>
			  <ul class="collection">
			    <?php
                  while ($row = mysqli_fetch_assoc($result3)) {
                  	$AssTitle = $row['title'];
                   	$AssDate = $row['submit_date'];
                   	$AssId = $row['assignmentId'];
                   	$AssMark = $row['mark'];
                   	$correction = $row['correction'];
                   	$avmark=$AssMark/2;
                   	?>
                   <li class="collection-item avatar">
				      <i class="material-icons circle green">folder</i>
				      <span class="title"><?php echo $AssTitle; ?></span>
				        <p><?php echo $AssDate; ?><br>
				        <?php
                         $sql4 = "SELECT * FROM answer WHERE  studentId=$studentId AND assignmentId = $AssId";
	                     $result4 = mysqli_query($conn,$sql4);
                         while ($row = mysqli_fetch_assoc($result4)) {
							$status = $row['status'];
							$mark = $row['mark'];
							if (isset($status)) {
								?>
								<span class="blue-text"><?php echo $status; ?></span>
								<?php
                                    if ($mark>=$avmark) {
                                    	?>
                                    	<span class="green-text"><?php echo $mark."/".$AssMark; ?></span>
                                    	<?php
                                    }
                                    elseif ($mark<$avmark) {
                                    	?>
                                    	<span class="red-text"><?php echo $mark."/".$AssMark; ?></span>
                                    	<?php
                                    }
                                    else{
                                    	?>
                                    	<span class="red-text"><?php echo "No mark given"; ?></span>
                                    	<?php
                                    }
							}
						 }
                          
				        ?>	
				        </p>
				        <?php
                           if (isset($status)=="MARKED" && $correction) {
                           	?>
                           	<a href="view_correction.php?AssId=<?php echo($AssId);?>" class="btn black secondary-content">view correction</a>
                           	<?php
                           }
                           else{
                           		?>
                           	<a href="view_tutorial.php?AssId=<?php echo($AssId);?>" class="btn black secondary-content">Answer</a>
                           	<?php
                           }
                         
				        ?>
				    </li>
                   	<?php
                  }
			    ?>
			  </ul>	
	    </div>
	    <!-- modals -->

	   <div id="modal2" class="modal">
  		<div class="modal-content">

  		<h4>Add Material</h4>
  		<form method="post" action="includes/material.inc.php" enctype="multipart/form-data">
	      <div class="input-field">
			<i class="material-icons prefix">create</i>
			<input type="text" name="title"  required>
			<label  for="title">Title</label>
		  </div>
		   <div class="input-field" style="display: none;">
			<i class="material-icons prefix">create</i>
			<input type="text" name="topicId"  value="<?php echo $topicId;?>" required>
			<label  for="title">topicId</label>
		  </div>
	  	<div class="file-field input-field">
	      <div class="btn">
	        <span>Upload PDF</span>
	        <input type="file" name="file">
	      </div>
	      <div class="file-path-wrapper">
	        <input class="file-path validate" type="text">
	      </div>
       </div>
       <div class="input-field">
		<i class="material-icons prefix"></i>
		<input type="text" name="date" id="date" value="<?php echo date("l jS \of F Y h:i:s A"); ?>" required>
		<label  for="date">Date</label>
	  </div>
       <button type="submit" name="submit" class="btn waves-effect black white-text waves-light" style="width: 100%;">SUBMIT</button>
      </form>
  		</div>
  	</div><br>

  	<!-- second modal -->
	    <div id="modal3" class="modal">
  		<div class="modal-content">

  		<h4>Add Tutorial</h4>
  		<form method="post" action="includes/assignment.inc.php" enctype="multipart/form-data">
  		<div class="input-field">
			<i class="material-icons prefix">create</i>
			<input type="text" name="title"  required>
			<label  for="title">Title</label>
		  </div>
		  <div class="file-field input-field">
		      <div class="btn">
		        <span>Upload PDF</span>
		        <input type="file"  name="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
          </div>
	  	  <div class="input-field">
			<i class="material-icons prefix">create</i>
			<input type="number" name="mark" id="mark" required>
			<label  for="email">Mark</label>
		  </div>
		  <div class="input-field" style="display: none;">
			<i class="material-icons prefix">create</i>
			<input type="text" name="topicId"  value="<?php echo $topicId;?>" required>
			<label  for="title">topicId</label>
		  </div>
        <div class="input-field">
		<i class="material-icons prefix"></i>
		<input type="text" name="date" id="date" value="<?php echo date("l jS \of F Y h:i:s A"); ?>" required>
		<label  for="date">Date</label>
	    </div>
       <button type="submit" name="submit" class="btn waves-effect black white-text waves-light" style="width: 100%;">SUBMIT</button>
      </form>
  		</div>
  	</div><br>

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
<?php
}
?>

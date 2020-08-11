<?php
session_start();
$teacherId = $_SESSION['teacherId'];
$email = $_SESSION['email'];
if (!isset($teacherId)&&!isset($teacherId)) {
	header("Location:index.php");
	exit();
}
else{
	require"../includes/db.inc.php";
	if (isset($_GET['topicId'])) {
		$topicId = $_GET['topicId'];
	}
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
			  	 <li class="collection-item avatar">
			      <img src="images/yuna.jpg" alt="" class="circle">
			      <span class="title"><b>Add Material </b></span>
			     <a href="#modal2" class="modal-trigger secondary-content"><i class="material-icons">add</i></a>
			    </li>
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
				      <a href="view_material.php?id=<?php echo($id);?>" class="btn black secondary-content">view</a>
				    </li>
                   	<?php
                   }

			    ?>
			  </ul>	
	    </div>
	    	<div id="test2" class="col s12"><br>
			  <ul class="collection">
			  	 <li class="collection-item avatar">
			      <img src="images/yuna.jpg" alt="" class="circle">
			      <span class="title"><b>Add Tutorial </b></span>
			     <a href="#modal3" class="modal-trigger secondary-content"><i class="material-icons">add</i></a>
			    </li>
			    <?php
                  while ($row = mysqli_fetch_assoc($result3)) {
                  	$AssTitle = $row['title'];
                   	$AssDate = $row['submit_date'];
                   	$AssId = $row['assignmentId'];
                   	?>
                   <li class="collection-item avatar">
				      <i class="material-icons circle green">folder</i>
				      <span class="title"><?php echo $AssTitle; ?></span>
				        <p><?php echo $AssDate; ?></p>	  
				      <a href="tutorials.php?id=<?php echo($AssId);?>" class="btn black secondary-content">view</a>
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

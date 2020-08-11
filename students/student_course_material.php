<?php
session_start();
$studentId = $_SESSION['studentId'];
$email = $_SESSION['email'];
if (!isset($email)&&!isset($studentId )) {
	header("Location:index.php");
	exit();
}
else if(isset($_GET['courseCode'])){
	require"../includes/db.inc.php";
	$courseCode = $_GET['courseCode'];
	//die($courseCode);		
	$sql = "SELECT * FROM course WHERE courseCode = '$courseCode'";
	$result = mysqli_query($conn,$sql);

	$sql2 = "SELECT * FROM topic WHERE courseCode = '$courseCode'";
	$result2 = mysqli_query($conn,$sql2);
	//die($result);
	while($row = mysqli_fetch_assoc($result)) {
		$courseCode = $row['courseCode'];
		$courseTitle = $row['courseTitle'];
	}
	$_SESSION['courseCode'] = $courseCode;

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
	<title>View Course Material</title>
</head>
<body>
	<?php
     include"student_nav.php";
	?>
	<div class="container">
		<div class="info">
			<h3 class="center-align"><?php echo $courseCode; ?><small><?php echo $courseTitle; ?></small> </h3>
			<!-- <h5 class="left-align">Topics</h5> -->
		</div>
		<hr>
		<h5>Topics</h5>
		<div id="test1" class="col s12"><br>
			  <ul class="collection">
			    <?php
			    if (mysqli_num_rows($result2)==0) {
			    	echo "<h4 class='blue-text center-align'>No topic has been posted for this course</h4>";
			    }
                 while ($row = mysqli_fetch_assoc($result2)) {
                 	$title = $row['topicName'];
                 	$date = $row['Date'];
                 	$topicId = $row['topicId'];
                 	?>
                 	 <li class="collection-item avatar">
				      <i class="material-icons circle green">folder</i>
				      <span class="title"><?php echo $title; ?></span>
				      <p><?php echo $date; ?></p>
				      <a href="student_topic_material.php?topicId=<?php echo($topicId);?>" class="btn black  secondary-content">view</a>
				    </li>
                 	<?php

                 	$_SESSION['topicId'] = $topicId;
                 }

			    ?>
			  </ul>	
	    </div>
	    <!-- modals -->
	   <div id="modal2" class="modal">
  		<div class="modal-content">

  		<h4>Add Topic</h4>
  		<form method="post" action="includes/create_topic.inc.php">
      <div class="input-field">
		<i class="material-icons prefix">create</i>
		<input type="text" name="topicName" id="courseTitle" required>
		<label  for="email">TopicName</label>
	  </div>
	    <div class="input-field">
		<i class="material-icons prefix"></i>
		<input type="text" name="date" id="date" value="<?php echo date("l jS \of F Y h:i:s A"); ?>" required>
		<label  for="date">Date</label>
	  </div>
       <button type="submit" name="create_topic" class="btn waves-effect black white-text waves-light" style="width: 100%;">SUBMIT</button>
      </form>
  		</div>
  	</div><br>

  	<!-- second modal -->
 
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
else{
	/*if(isset($_GET['success'])){
	header("Location: course_material.php?courseCode=$courseCode");
	die();
	}
	else{

	header("Location: index.php");
	die();
	}*/
}
?>

<?php
require"../includes/db.inc.php";
if(isset($_GET['status']) && $_GET['status'] = 'tutorial'){

	$assId = $_GET['id'];

	$sql = "SELECT * FROM assignment WHERE assignmentId = $assId";
	$result = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$title = $row['title'];
		$content = $row['content'];
	}
}
else if (isset($_GET['id'])) {
	$contentId = $_GET['id'];

	$sql = "SELECT * FROM topiccontent WHERE contentId = $contentId";
	$result = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$title = $row['title'];
		$content = $row['content'];
	}
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
	<title>View Material</title>
	<style type="text/css">
		body{
			background-color: rgba(0,0,0,0.9);
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<h4 class="center-align white-text"><?php echo($title);?></h4>
		<div class="col s12 white z-depth-3" style="padding:5px; ">	
			<embed src="../uploads/<?php echo($content);?>" type="application/pdf" width="100%" height="700">
		</div>
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
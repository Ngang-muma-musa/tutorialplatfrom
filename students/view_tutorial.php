<?php
require"../includes/db.inc.php";

if (isset($_GET['AssId'])) {
	$contentId = $_GET['AssId'];

	$sql = "SELECT * FROM assignment WHERE assignmentId = $contentId";
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
			
			<div class="from ">
				<h4 class="teal-text">Upload Answer</h4>
				<form method="post" action="includes/answer.inc.php" enctype="multipart/form-data">
				<div class="input-field" style="display: none;">
					<i class="material-icons prefix">create</i>
					<input type="text" name="AssId"  value="<?php echo $contentId;?>" required>
					<label  for="title">contentId</label>
				 </div>	
				 <div class="file-field input-field">
			      <div class="btn blue">
			        <span>Upload PDF</span>
			        <input type="file"  name="file">
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
<?php
require"../includes/db.inc.php";

if (/*isset($_GET['id'])&&*/isset($_GET['ansId'])) {
	$ansId = $_GET['ansId'];
    $AssId = $_GET['AssId'];


	$sql = "SELECT * FROM answer WHERE ansId = $ansId ";
	$result = mysqli_query($conn,$sql);

	while ($row = mysqli_fetch_assoc($result)) {
		
		$content = $row['answer'];
	}

	$sql2 = "SELECT mark FROM assignment WHERE assignmentId = $AssId";
	$result2 = mysqli_query($conn,$sql2);

	while ($row = mysqli_fetch_assoc($result2)) {
		
		$mark = $row['mark'];
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
		<h4 class="center-align white-text"><?php echo("Score on $mark");?></h4>
		<div class="col s12 white z-depth-3" style="padding:5px; ">	
			<embed src="../uploads/<?php echo($content);?>" type="application/pdf" width="100%" height="700">
           <div class="mark">
           	<form method="post" action="includes/assignment_view.inc.php">
           		<div class="input-field">
					<i class="material-icons prefix">create</i>
					<input type="number" name="mark"  required>
					<label  for="title">Input student mark</label>
				</div>
				<div class="input-field" style="display: none;">
					<i class="material-icons prefix">create</i>
					<input type="text" name="ansId"  value="<?php echo $ansId;?>" required>
					<label  for="title">AnswerId</label>
				</div>
				<div class="input-field" style="display: none;">
					<i class="material-icons prefix">create</i>
					<input type="text" name="AssId"  value="<?php echo $AssId;?>" required>
					<label  for="title">assignmentid</label>
				</div>
                <!--<input type="submit" name="submit" class="btn waves-effect blue white-text waves-light" style="width: 100%;" value="SUBMIT" >-->
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
  	});
  </script>
</body>
</html>
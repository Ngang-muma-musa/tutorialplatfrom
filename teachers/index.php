<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	 <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style type="text/css">
      	  body{
		    font-family: Microsoft New Tai Lue;
		 } 
      	.btn{
      		width: 100%;
      		margin-bottom: 2rem;
      	}
      	.pading{
      		padding: 2rem;
            margin-top: 10%;
      	}
      	span{
      		font-weight:medium;
      		color: rgba(0,0,0,0.5);
      	}
      </style>
</head>
<body class="#69f0ae green accent-2">
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
		<div class="row">
			<div class="col s12 m2 l4"></div>
			<div class="col s12 m8 l4 white pading  darken-1 z-depth-4">
				<h4 class="center-align">TEACHER</h4>
				<h5 class="center-align">LOGIN</h5><br>
				<form method="post" action="includes/login.inc.php">
					<div class="input-field">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="email" id="email" placeholder="Enter Email..." required>
						<label  for="email">Email</label>
					</div><br>
					<div class="input-field">
						<i class="material-icons prefix">lock</i>
						<input type="password" name="pwd"  placeholder="Enter Password..." required>
						<label  for="pwd">Password</label>
					</div><br>
					<button type="submit" name="login" class="btn waves-effect #69f0ae green accent-2  white-text waves-light">Login</button>
					<button data-target="modal1" class="btn modal-trigger waves-effect #69f0ae black lighten-1  white-text waves-light">Register</button>
				</form>
				<a href="../students/index.php" class="btn blue "> Go To Student  login</a>
		<!-- /////////////////modal///////////////// -->
				  <div id="modal1" class="modal">
				    <div class="modal-content">
				      <h4 class="center-align">Register</h4><br>
						<form method="post" action="includes/register.inc.php">
							<div class="input-field">
								<i class="material-icons prefix">create</i>
								<input type="text" name="firstName" id="firstName" required>
								<label  for="firstName">First Name</label>
							</div>
							<div class="input-field">
								<i class="material-icons prefix">create</i>
								<input type="text" name="lastName" required="">
								<label  for="lastName">Last Name</label>
							</div>
							<div class="input-field">
								<i class="material-icons prefix">create</i>
								<input type="email" name="email" required="" >
								<label  for="email">Email</label>
							</div>
							<div class="input-field">
								<i class="material-icons prefix">create</i>
								<input type="password" name="pwd" required="" >
								<label  for="password">Password</label>
							</div>
							<div class="input-field">
								<i class="material-icons prefix">create</i>
								<input type="password" name="pwd2" required="">
								<label  for="pwd2">Repeat Password</label>
							</div>
							<button type="submit" name="register" class="btn waves-effect #69f0ae green accent-2  white-text waves-light">Login</button>	
						</form>
					    </div>
				  </div>
			</div>
			<div class="col s12 m2 l4"></div>
		</div>
	</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
     $('.modal').modal();
    });
  </script>
</body>
</html>
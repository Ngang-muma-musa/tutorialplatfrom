	<nav class="#69f0ae green accent-2 darken-3">
		<div class="container">
		<div class="nav-wrapper">
			
					<a href="#" class="brand-logo ">TutorialPlatform</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<!-- <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a> -->
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a href="#modal1" class=" modal-trigger"><i class="material-icons">add</i></a></li>
						<li><a href="students.php">Home</a></li>
						<li><a href="">Courses</a></li>
						<li>
							<form method="post" action="../includes/logout.inc.php">
							<button type="submit" name="logout" class="btn black lighten-2 white-text">Logout</button>
						    </form>
						</li>
					</ul>
			</div>
		</div>
	</nav>
    	<ul class="sidenav" id="mobile-demo">
            <li><a href="#modal1" class=" modal-trigger"><i class="material-icons">add</i></a></li>
            <li><a href="students.php">Home</a></li>
            <li><a href="">Courses</a></li>

            <li>
                <form method="post" action="../includes/logout.inc.php">
                  <button type="submit" name="logout" class="btn black lighten-2 white-text">Logout</button>
                </form>
            </li>
        </ul>
	  	<div id="modal1" class="modal">
  		<div class="modal-content">

  		<h4>REGISTER COURSE</h4>
  		<form method="post" action="includes/course_registration.inc.php">
	      <div class="input-field">
			<i class="material-icons prefix">create</i>
			<input type="text" name="courseCode" id="courseCode" required>
			<label  for="email">Coursecode</label>
		  </div>
	       <button type="submit" name="register_course" class="btn waves-effect black white-text waves-light" style="width: 100%;">SUBMIT</button>
	    </form>
  		</div>
  	</div><br>
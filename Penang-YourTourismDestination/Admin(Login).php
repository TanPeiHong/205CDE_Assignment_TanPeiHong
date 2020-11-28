<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="Styles.css">
		<link rel="stylesheet" href="Styles(AdminLogin_Form).css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<link rel="icon" href="Images/Penang_Icon.png" type="image/png" />
		<title>Penang - Your Tourism Destination</title>
		
		<style>
			h2 {
				color: black;
				background-color: #33ccff;
				margin: 50px 300px;
				padding: 15px;
			}
			
			h3 {
				color: #33ccff;
				font-size: 30px;
			}
			
			hr {
				border: 1px solid black;
				margin-bottom: 25px;
			}
			
			label {
				color: black;
			}
		</style>
	</head>
	<body>
		<script type="text/javascript">
			//Function for toggle to dark mode
			function modeFunction(){
				var element = document.body;
				element.classList.toggle("dark-mode");
			}
			
			//Function for toggle between password visibility
			function showPassword(){
				var p = document.getElementById("password");
				
				if (p.type == "password"){
					p.type = "text";
				}
				
				else {
					p.type = "password";
				}
			}
		</script>
		
		<!-- Header -->
		<?php
			include("Penang(Header).html");
		?>
		
		<!-- Top navigation bars -->
		<div class="topnav">
			<a href="Home.html">Home</a>
			<a href="Culture-Heritage.html">Culture & Heritage</a>
			<a href="Nature-Adventure.html">Nature & Adventure</a>
			<a href="Food-Lifestyle.html">Food & Lifestyle</a>
			<a href="AboutUs.html">About Us</a>
			<a href="ContactUs.php">Contact Us</a>
			<a class="active" href="Admin(Login).php">Admin</a>
			
			<!-- Dropdown bars -->
			<div class="dropdown">
				<button class="dropbtn">Appearance
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<button onclick="modeFunction()">Light / Dark mode</button>
				</div>
			</div> 
		</div>
		
		<h2>ADMIN (LOGIN)</h2>
		
		<?php
			if (isset($_POST['submitted'])){
				$userName = $_POST['userName'];
				$password = $_POST['password'];
				
				//If user have enter the correct username and password, it will redirect to Admin(Dashboard).html page
				if (!empty($userName) && !empty($password)){
					if ($userName == "Admin" && $password == "admin123"){
						//Redirect to the Admin(Dashboard).html page
						header("Location: Admin(Dashboard).html");
						exit(); //This is to make sure that code below does not get executed after we redirecte to another page
					}
					else {
						//Display the alert message if user enter incorrect username or password
						echo "<script type='text/javascript'>alert('Login Failed. Username or password are incorrect.');</script>";
						
						//Display the Login form again
						echo '<form action="Admin(Login).php" name="form" method="post">
								<div class="imgcontainer">
									<img src="Images/Admin.png" class="admin">
								</div>
								
								<div class="containerBlock">
									<label for="userName"><b>Username</b></label>
									<input type="text" placeholder="Enter Username" name="userName" required>
									
									<label for="password"><b>Password</b></label>
									<input type="password" placeholder="Enter Password" name="password" id="password" required>
									
									<!-- An element to toggle between password visibility -->
									<input type="checkbox" onclick="showPassword()"><label>Show Password</label>
									
									<br /><br />
									
									<input type="submit" name="login" value="Login">
									<input type="hidden" name="submitted" value="true">
								</div>
							</form>';
					}
				}
				
				else {
					echo "<script type='text/javascript'>alert('Please fill in Username and Password.');</script>";
				}
			}
			
			else {
		?>
		
		<form action="Admin(Login).php" name="form" method="post">
			<div class="imgcontainer">
				<img src="Images/Admin.png" class="admin">
			</div>
			
			<div class="containerBlock">
				<label for="userName"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="userName" required>
				
				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" id="password" required>
				
				<!-- An element to toggle between password visibility -->
				<input type="checkbox" onclick="showPassword()"><label>Show Password</label>
				
				<br /><br />
				
				<input type="submit" name="login" value="Login">
				<input type="hidden" name="submitted" value="true">
			</div>
		</form>
		
		<?php
			}
		?>
		
		<br /><br /><br />
		<!-- Footer -->
		<?php
			include("Penang(Footer).html");
		?>
	</body>
</html>
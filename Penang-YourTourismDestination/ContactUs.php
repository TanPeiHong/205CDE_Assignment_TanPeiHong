<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="Styles.css">
		<link rel="stylesheet" href="Styles(ContactUs_Form).css">
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
			
			img {
				display: block;
				margin-left: auto;
				margin-right: auto;
				height: 400px;
				width: 620px;
			}
			
			label {
				color: black;
			}
			
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<script type="text/javascript">
			//Function for toggle to dark mode
			function modeFunction(){
				var element = document.body;
				element.classList.toggle("dark-mode");
			}
			
			/*** Verify the Contact Us form ***/
			function btnCheckForm_onclick(){
				var myForm = document.form;
				
				//Display the alert message if user does not fill in all the input
				if (myForm.fullName.value == "" || myForm.email.value == "" || myForm.phone.value == "" || myForm.subject.value == ""){
					alert("Please fill in all the required field.");
					
					if (myForm.fullName.value == ""){
						myForm.fullName.focus();
					}
					if (myForm.email.value == ""){
						myForm.email.focus();
					}
					if (myForm.phone.value == ""){
						myForm.phone.focus();
					}
					else {
						myForm.subject.focus();
					}
				}
				
				//Display the alert message if user have fill in all the input
				else {
					alert("Thanks for completing the form!");
				}
			}
			
			/*** Verify the full name ***/
			function name_onblur(){
				var fullName = document.form.fullName;
				
				//Check that the user enter correct full name or not
				//Validate a single or more than one fields with alphabet characters (A-Z or a-z) and spaces
				var letters = /^[A-Za-z ]+$/;
				
				if (fullName.value.match(letters)){
				
					return true;
				}
				
				//Display the alert message if user enter invalid full name
				else {
					alert("Please enter a valid Full name.");
					
					fullName.focus();
					fullName.select();
				}
			}
			
			/*** Verify the email address ***/
			function email_onblur(){
				var email = document.form.email;
				
				//Check that the user enter correct email address or not
				var emailFormat = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-z]{2,3})$/;
				
				if (email.value.match(emailFormat)){
					
					return true;
				}
				
				//Display the alert message if user enter invalid email address
				else {
					alert("Please enter a valid Email address.");
					
					email.focus();
					email.select();
				}
			}
			
			/*** Verify the phone number ***/
			function phone_onblur(){
				var phone = document.form.phone;
				
				//Check that the user enter correct phone number or not
				//Validate a phone number of 10 digits with no comma, no spaces, no punctuation and there will be no + sign in front the number
				var phoneNumber = /^\d{10}$/;
				
				if (phone.value.match(phoneNumber)){
					
					return true;
				}
				
				//Display the alert message if user enter invalid phone number
				else {
					alert("Please enter a valid Phone number.");
					
					phone.focus();
					phone.select();
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
			<a class="active" href="ContactUs.php">Contact Us</a>
			<a href="Admin(Login).php">Admin</a>
			
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
		
		<h2>CONTACT US</h2>
		
		<?php
			if (isset($_POST['submitted'])){
				//Create connection
				$dbc = mysqli_connect('localhost', 'root', '');
				
				//Check connection
				if (!$dbc){
					die("Connection failed: " . mysqli_connect_error());
				}
				
				//Change the default database to myforms database for the connection
				mysqli_select_db($dbc, 'myforms');
				
				$fullName = $_POST['fullName'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$subject = $_POST['subject'];
				
				$problem = FALSE; //No problem so far
				
				//Check user have enter somethings or not
				if (!empty($fullName) && !empty($email) && !empty($phone) && !empty($subject)){
					//Check again whether user enter valid information or not
					$letters = "/^[A-Za-z ]+$/";
					$phoneNumber = "/^\d{10}$/";
					
					/*** Verify the Full Name ***/
					if (!preg_match($letters ,$fullName)){
						echo '<script type="text/javascript">alert("Please enter a valid Full name.");</script>';
		?>
						<!-- Display the form again and let user to enter the Full Name only -->
						<div class="containerBlock">
							<form action="ContactUs.php" name="form" method="post">
								<p style="color: black;"><b>If you have any hesitation, please fill in this form for futher communication. &#128516;</b></p>
								<hr>
								
								<span class="error">* required field</span>
								<br /><br />
								
								<label for="fullName">Full Name</label><span class="error"> *</span>
								<input type="text" id="fullName" name="fullName" placeholder="Enter your full name..." onchange="name_onblur()" required>
								
								<label for="email">Email</label><span class="error"> *</span>
								<input type="text" id="email" name="email" value="<?php if (isset($email)){ echo htmlspecialchars($email); } ?>"
								placeholder="Enter your email..." onchange="email_onblur()" required>
								
								<label for="phone">Phone</label><span class="error"> *</span>
								<input type="text" id="phone" name="phone" value="<?php if (isset($phone)){ echo htmlspecialchars($phone); } ?>"
								placeholder="Enter your phone number..." onchange="phone_onblur()" required>
								
								<label for="subject">Subject</label><span class="error"> *</span>
								<textarea id="subject" name="subject" placeholder="Write something..." 
								style="height:200px"><?php if (isset($subject)){ echo htmlspecialchars($subject); } ?></textarea>
								
								<input type="submit" name="submit" value="Submit" onclick="btnCheckForm_onclick()">
								<input type="hidden" name="submitted" value="true">
							</form>
						</div>
		<?php
						$problem = TRUE;
					}
					/*** Verify the Email Address ***/
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
						echo '<script type="text/javascript">alert("Please enter a valid Email address.");</script>';
		?>
						<!-- Display the form again and let user to enter Email Address only -->
						<div class="containerBlock">
							<form action="ContactUs.php" name="form" method="post">
								<p style="color: black;"><b>If you have any hesitation, please fill in this form for futher communication. &#128516;</b></p>
								<hr>
								
								<span class="error">* required field</span>
								<br /><br />
								
								<label for="fullName">Full Name</label><span class="error"> *</span>
								<input type="text" id="fullName" name="fullName" value="<?php if (isset($fullName)){ echo htmlspecialchars($fullName); } ?>"
								placeholder="Enter your full name..." onchange="name_onblur()" required>
								
								<label for="email">Email</label><span class="error"> *</span>
								<input type="text" id="email" name="email" placeholder="Enter your email..." onchange="email_onblur()" required>
								
								<label for="phone">Phone</label><span class="error"> *</span>
								<input type="text" id="phone" name="phone" value="<?php if (isset($phone)){ echo htmlspecialchars($phone); } ?>"
								placeholder="Enter your phone number..." onchange="phone_onblur()" required>
								
								<label for="subject">Subject</label><span class="error"> *</span>
								<textarea id="subject" name="subject" placeholder="Write something..." 
								style="height:200px"><?php if (isset($subject)){ echo htmlspecialchars($subject); } ?></textarea>
								
								<input type="submit" name="submit" value="Submit" onclick="btnCheckForm_onclick()">
								<input type="hidden" name="submitted" value="true">
							</form>
						</div>
		<?php
						$problem = TRUE;
					}
					/*** Verify the Phone Number ***/
					if (!preg_match($phoneNumber ,$phone)){
						echo '<script type="text/javascript">alert("Please enter a valid Phone number.");</script>';
		?>
						<!-- Display the form again and let user to enter the Phone Number only -->
						<div class="containerBlock">
							<form action="ContactUs.php" name="form" method="post">
								<p style="color: black;"><b>If you have any hesitation, please fill in this form for futher communication. &#128516;</b></p>
								<hr>
								
								<span class="error">* required field</span>
								<br /><br />
								
								<label for="fullName">Full Name</label><span class="error"> *</span>
								<input type="text" id="fullName" name="fullName" value="<?php if (isset($fullName)){ echo htmlspecialchars($fullName); } ?>"
								placeholder="Enter your full name..." onchange="name_onblur()" required>
								
								<label for="email">Email</label><span class="error"> *</span>
								<input type="text" id="email" name="email" value="<?php if (isset($email)){ echo htmlspecialchars($email); } ?>"
								placeholder="Enter your email..." onchange="email_onblur()" required>
								
								<label for="phone">Phone</label><span class="error"> *</span>
								<input type="text" id="phone" name="phone" placeholder="Enter your phone number..." onchange="phone_onblur()" required>
								
								<label for="subject">Subject</label><span class="error"> *</span>
								<textarea id="subject" name="subject" placeholder="Write something..." 
								style="height:200px"><?php if (isset($subject)){ echo htmlspecialchars($subject); } ?></textarea>
								
								<input type="submit" name="submit" value="Submit" onclick="btnCheckForm_onclick()">
								<input type="hidden" name="submitted" value="true">
							</form>
						</div>
		<?php
						$problem = TRUE;
					}
					//Correct
					else {
						$fullName = trim($_POST['fullName']);
						$email = trim($_POST['email']);
						$phone = trim($_POST['phone']);
						$subject = trim($_POST['subject']);
					}
				}
				//Check if user submit empty form
				else {
					$problem = TRUE;
				}
				
				//If no problem, the form that user submitted will be added to the database
				if (!$problem){
					//INSERT INTO statement is used to add new records to a entries table
					$query = "INSERT INTO entries(entry_id, full_name, email, phone, subject, date_entered) VALUES (0, '$fullName', '$email', '$phone', '$subject', NOW())";
					
					if (@mysqli_query($dbc, $query)){
						//Display the output, if the form entry has been added to the database
						echo '<script type="text/javascript">alert("The form entry has been added to the database!");</script>';
						
						//Display the form again, if user want to enter again
						echo '<div class="containerBlock">
								<form action="ContactUs.php" name="form" method="post">
									<p style="color: black;"><b>If you have any hesitation, please fill in this form for futher communication. &#128516;</b></p>
									<hr>
									
									<span class="error">* required field</span>
									<br /><br />
									
									<label for="fullName">Full Name</label><span class="error"> *</span>
									<input type="text" id="fullName" name="fullName" placeholder="Enter your full name..." onchange="name_onblur()" required>
									
									<label for="email">Email</label><span class="error"> *</span>
									<input type="text" id="email" name="email" placeholder="Enter your email..." onchange="email_onblur()" required>
									
									<label for="phone">Phone</label><span class="error"> *</span>
									<input type="text" id="phone" name="phone" placeholder="Enter your phone number..." onchange="phone_onblur()" required>
									
									<label for="subject">Subject</label><span class="error"> *</span>
									<textarea id="subject" name="subject" placeholder="Write something..." style="height:200px"></textarea>
									
									<input type="submit" name="submit" value="Submit" onclick="btnCheckForm_onclick()">
									<input type="hidden" name="submitted" value="true">
								</form>
							</div>';
					}
					else {
						//Display the error message, if could not add the entry
						echo '<p style="color: red;">Could not add the entry because: <br />' . mysqli_error($dbc) . '</p><p>The query was ' . $query . '</p>';
					}
				}
				
				mysqli_close($dbc); //Close the connection
			}
			
			else {
		?>
		
		<div class="containerBlock">
			<form action="ContactUs.php" name="form" method="post">
				<p style="color: black;"><b>If you have any hesitation, please fill in this form for futher communication. &#128516;</b></p>
				<hr>
				
				<span class="error">* required field</span>
				<br /><br />
				
				<label for="fullName">Full Name</label><span class="error"> *</span>
				<input type="text" id="fullName" name="fullName" placeholder="Enter your full name..." onchange="name_onblur()" required>
				
				<label for="email">Email</label><span class="error"> *</span>
				<input type="text" id="email" name="email" placeholder="Enter your email..." onchange="email_onblur()" required>
				
				<label for="phone">Phone</label><span class="error"> *</span>
				<input type="text" id="phone" name="phone" placeholder="Enter your phone number..." onchange="phone_onblur()" required>
				
				<label for="subject">Subject</label><span class="error"> *</span>
				<textarea id="subject" name="subject" placeholder="Write something..." style="height:200px" required></textarea>
				
				<input type="submit" name="submit" value="Submit" onclick="btnCheckForm_onclick()">
				<input type="hidden" name="submitted" value="true">
			</form>
		</div>
		
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
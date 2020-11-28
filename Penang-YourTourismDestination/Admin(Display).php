<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		
		<!--Load an icon library-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		
		<!-- Popper.js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		
		<!-- Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		
		<link rel="icon" href="Images/Penang_Icon.png" type="image/png" />
		<title>Penang - Your Tourism Destination</title>
		
		<style>
			h3 {
				text-align: center;
			}
			
			.container-dashboard {
				border: 6px solid #f1f1f1;
				margin: 50px 500px;
				padding: 35px;
				text-align: justify;
			}
		</style>
	</head>
	<body>
		<!-- Top navigation bars -->
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<!-- Logo -->
			<a class="navbar-brand" href="Home.html">
				<img src="Images/Penang_Icon.png" height="35" width="35">
			</a>
			
			<!-- Links -->
			<ul class="navbar-nav nav nav-pills">
				<li class="nav-item">
					<a class="nav-link" href="Admin(Dashboard).html">Home</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link active" href="Admin(Display).php">View Records</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link disabled" href="Admin(Delete).php">Delete Records</a>
				</li>
			</ul>
		</nav>
		
		<div id="clock" style="color:white; position:absolute; top:0px; right:0px;">
		
		<?php
			//This function sets the default timezone
			date_default_timezone_set("Asia/Kuala_Lumpur");
			
			/*
				[Description]
				--------------------------------------------------------
				d - The day of the month (from 01 to 31)
				m - A numeric representation of a month (from 01 to 12)
				Y - A four digit representation of a year
				H - 24-hour format of an hour (00 to 23)
				i - Minutes with leading zeros (00 to 59)
				s - Seconds, with leading zeros (00 to 59)
				A - Uppercase AM or PM
				--------------------------------------------------------
			*/
			echo date("d/m/Y H:i:s A"); //This function formats a local date and time
		?>
		
		</div>
		
		<?php
			//Create connection
			$dbc = mysqli_connect('localhost', 'root', '');
			
			//Check connection
			if (!$dbc){
				die("Connection failed: " . mysqli_connect_error());
			}
			
			//Change the default database to myforms database for the connection
			mysqli_select_db($dbc, 'myforms');
			
			//Select all the records from the entries table and sort the records in descending order
			$query = 'SELECT * FROM entries ORDER BY date_entered DESC';
			
			if ($r = mysqli_query($dbc, $query)){
				echo "<h3>View Records (Forms)</h3>";
				
				//Display all the forms that users have submitted
				while ($row = mysqli_fetch_array($r)){
					echo "<div class='container-dashboard'>
							<hr />
							<p><b>Entry ID:</b> {$row['entry_id']} <br />
								<b>Full Name:</b> {$row['full_name']} <br />
								<b>Email:</b> {$row['email']} <br />
								<b>Phone:</b> {$row['phone']} <br />
								<b>Subject:</b> {$row['subject']} <br />
								<b>Date Entered:</b> {$row['date_entered']} <br />
								
								<a href=\"Admin(Delete).php?id={$row['entry_id']}\">Delete</a>
							</p>
							<hr />
						</div>";
				}
			}
			
			else {
				//Display the error message, if could not retrieve the data
				echo '<p style="color: red;">Could not retrieve the data because: <br />' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
			}
			
			mysqli_close($dbc); //Close the connection
		?>
	</body>
</html>
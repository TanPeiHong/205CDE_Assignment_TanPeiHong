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
					<a class="nav-link" href="Admin(Display).php">View Records</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link active" href="Admin(Delete).php">Delete Records</a>
				</li>
			</ul>
		</nav>

		<?php
			//Create connection
			$dbc = mysqli_connect('localhost', 'root', '');
			
			//Check connection
			if (!$dbc){
				die("Connection failed: " . mysqli_connect_error());
			}
			
			//Change the default database to myforms database for the connection
			mysqli_select_db($dbc, 'myforms');
			
			//Display the entry in a form
			if (isset($_GET['id']) && is_numeric($_GET['id'])){
				//Define the query. Select the record from the entries table and extract only the record that fulfill a specified condition
				$query = "SELECT full_name, email, phone, subject FROM entries WHERE entry_id = {$_GET['id']}";
				
				//Run the query
				if ($r = mysqli_query($dbc, $query)){
					echo "<h3>Delete Records [Forms (Delete)]</h3>";
					
					$row = mysqli_fetch_array($r); //Retrive the information
				
					//Make the form
					echo '<div class="container-dashboard">
							<form action="Admin(Delete).php" method="post">
								<h3>Are you sure you want to delete this entry?</h3>
								<hr />
								<p><b>Full Name:</b> ' . $row['full_name'] . '<br />
									<b>Email:</b> ' . $row['email'] . '<br />
									<b>Phone:</b> ' . $row['phone'] . '<br />
									<b>Subject:</b> ' . $row['subject'] . '<br /><br />
									
									<input type="hidden" name="id" value="' . $_GET['id'] . '" />
									<input type="submit" name="submit" value="Delete this Entry!" />
								<hr />
								</p>
							</form>
						</div>';
				}
				
				//Display the error message, if could not retrieve the data
				else {
					echo '<p style="color: red;">Could not retrieve the blog entry because: <br />' . mysqli_error($dbc) . '</p>';
				}
			}
			
			//Handle the form
			else if (isset($_POST['id']) && is_numeric($_POST['id'])){
				//Define the query
				//WHERE clause specifies which record or records that should be deleted
				//LIMIT clause that is used to specify the number of records to return
				$query = "DELETE FROM entries WHERE entry_id = {$_POST['id']} LIMIT 1";
				$r = mysqli_query($dbc, $query); //Execute the query
				
				//Report on the result
				if (mysqli_affected_rows($dbc) == 1){
					//Display the output, if the form entry has been deleted from the database
					echo '<p>The form entry has been deleted from the database.</p>';
				}
				else {
					echo '<p style="color: red;">Could not delete the blog entry because: <br />';
				}
			}
			
			//No ID set
			else {
				echo '<p style="color: red;">This page has been accessed in error.</p>';
			}
			
			mysqli_close($dbc); //Close the connection
		?>
	</body>
</html>
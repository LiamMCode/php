<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset="utf-8"/>
		<Title>Cars.com Login Page</title> <!-- title is shown in the tab of the web browser -->
		<link rel="stylesheet" href="stylesheet1.css"/> <!-- link to the css stylesheet for the entire website-->
		<script src="scriptsheet.js"></script>
	</head>
	<body>
		<div class="navbar">
			<a href="index.html">Home</a>
			<a href="About.html">About Us</a>
			<div class="dropdown">
				<button class="dropbtn">European  
				<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="Maserati.html">Maserati</a>
					<a href="Lamborghini.html">Lamborghini</a>
					<a href="Ferrari.html">Ferrari</a>
					<a href="Audi.html">Audi</a>
					<a href="Koenigsegg.html">Koenigsegg</a>
					<a href="Rimac.html">Rimac</a>
					<a href="Bugatti.html">Bugatti</a>
					<a href="Mercades-Benz.html">Mercades-Benz</a>
					<a href="Porsche.html">Porsche</a>
					<a href="Pagani.html">Pagani</a>
					<a href="Lancia.html">Lancia</a>
				</div>
			</div> 
			<div class="dropdown">
				<button class="dropbtn">Rest Of The World  
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="Mitsubishi.html">Mitsubishi</a>
					<a href="Dodge.html">Dodge</a>
					<a href="Nissan.html">Nissan</a>
					<a href="Ford.html">Ford</a>
					<a href="Chevrolet.html">Chevrolet</a>
				</div>
			</div>	
			<div class="dropdown">
				<button class="dropbtn">UK  
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="AstonMartin.html">Aston Martin</a>
					<a href="TVR.html">TVR</a>
					<a href="Lotus.html">Lotus</a>
					<a href="Jaguar.html">Jaguar</a>
					<a href="Mclaren.html">Mclaren</a>
				</div>
			</div>
			<a href="login.php" style="float:right" >Login</a>
		</div>

		<form action="" method="get">  <!-- form for login -->
		User name:<p> &nbsp; </p> <input id ="textbox" name="User-name" />
		<p> &nbsp; </p>Password:<p> &nbsp; </p><input id ="textbox" name="Pass-word"/>
		<p> &nbsp; </p><input type="submit" name= "Submit" value="Submit"/> 
		</form> 

		<?php
		$userN = $_GET['User-name']; // Login
		$passW = $_GET['Pass-word'];
		$myFile = fopen("read.txt", "r") or die("Cannot open file, try again");
		$userList = fread($myFile, filesize("read.txt"));

		$success = false;

		$user_full = explode("\n", $userList);
		foreach($user_full as $userLine)
		{
			$user_details = explode(' | ', $userLine);
			if(($userN === $user_details[0]) && ($passW === $user_details[1]))
			{
				$success = true;
				if($user_details[2] === "Admin") // checking if user has logged into Admin account
				{
					$userStatus = "Admin";
				}
				else
				{
					$userStatus = "User"; // checking if user has logged into User account
				}
			}
		}
		if($success == true)
		{
			echo "<br> Hello $userN <br>";
				
		}
		elseif($success == false && $userN != "") // Wrong password or user-name
		{	
			echo "Username or Password is incorrect";
		}
		?>
	<body>
<html>
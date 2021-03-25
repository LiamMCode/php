<form action="" method="get">  <!-- form for login -->
User name:<br> <input type="text" name="User-name" />
<br>Password:<br><input type="text" name="Pass-word"/>
<br><br><input type="submit" name= "Submit" value="Submit"/> 
</form> 

<?php
   if(isset($_FILES['image'])) //file uploading section 
   {
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false)
	  {
         $errors[]="Only JPEG or PNG files are allowed."; 
      }
      
      if($file_size > 2097152)
	  {
         $errors[]='File size must be exactly 2 MB';
      }
      
      if(empty($errors)==true)
	  {
         move_uploaded_file($file_tmp,"img/".$file_name);
         echo "file has been uploaded";
      }
	  else
	  {
         print_r($errors);
      }
   }
?>
<html> <!-- form for uploading images -->
   <body>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="image" />
			<input type="submit"/>
		</form>
	</body>
</html>

<?php
$dir = "img/"; //Directory Source
if (is_dir($dir))
{
  if ($dh = opendir($dir))
  { 
    while (($file = readdir($dh)) !== false)
	{
      echo "filename: <a href=\"img/$file\">" . $file . "</a><br>"; 
    }
    closedir($dh); 
  }
}

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
	echo "<br> hello $userN <br>"; 
}
else //error logging 
{
	echo "<br> The wrong user-name or password has been entered."; 
	$myfile = fopen("Errors.txt", "w") or die("Cannot open file");
	$txt= "Wrong password or user-name entered ". date("d-m-Y"); 
	fwrite($myfile, $txt). "<br>";
	fclose($myfile);
}
if($success == true) //When user is logged in
{
	// Control Panel
	echo "<p> $userStatus is enabled </p>";
	if ($userStatus === "Admin")
	{
		echo"<p><a href=\"\">Control Panel</a></p>";
	}
	else // Wrong password or user-name
	{
		
		$myfile = fopen("Error Log.txt", "w") or die("Cannot open file");
		$txt= "Error Found. Wrong password or user-name entered". date("d-m-Y");
		fwrite($myfile, $txt). "<br>";
		fclose($myfile);
	}
}
echo $_SERVER['REMOTE_ADDR']; //Displaying IP Address
$myfile = fopen("VisitorLog.txt", "w") or die("Cannot open file"); 
$ip=$_SERVER['REMOTE_ADDR'];
$txt= "User IP Address is:" .$ip. ", The date is:". date("d-m-Y"); 
fwrite($myfile, $txt). "<br>";
fclose($myfile);
?>
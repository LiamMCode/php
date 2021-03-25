<?php
session_start();
if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){
    echo 'User resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
    $_SESSION['screen_width'] = $_REQUEST['width']; //finds the users screen width
    $_SESSION['screen_height'] = $_REQUEST['height']; //finds the users screen height
    header('Location: ' . $_SERVER['PHP_SELF']);
} else {
    echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>'; // prints the screen resolution to screen
}
?>

<?php
function getBrowser()
{
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$browserName = 'Unknown';

	if(preg_match('/Chrome/i',$userAgent)) // if chrome is the browser 
	{
		$browserName = 'Google Chrome'; // then browser name is this  
	}
	elseif(preg_match('/Windows NT 6.1/i',$userAgent)) // if Internet Explorer is the browser 
	{
		$browserName = 'Internet Explorer'; // then browser name is this 
	}
	elseif(preg_match('/Firefox/i',$userAgent)) // if Firefox is the browser 
	{
		$browserName = 'Mozilla Firefox'; // then browser name is this 
	}
	elseif(preg_match('/Safari/i',$userAgent)) // if Safari is the browser 
	{
		$browserName = 'Apple Safari'; // then browser name is this 
	}
	elseif(preg_match('/Opera/i',$userAgent)) // if Opera is the browser 
	{
		$browserName = 'Opera'; // then browser name is this 
	}
	return array( // returns the browser name to the function 
		'name'	=> $browserName,
	);
}

$ua=getBrowser();
$yourbrowser="browser: " . $ua['name'];
print_r($yourbrowser); // displays the browser type on screen

$myfile = fopen("browserType.txt", "r") or die("Unable to open file!"); //opens the text file
fread($myfile,filesize("browserType.txt")); //reads the file
fclose($myfile); //closes file

$myfile = fopen("browserType.txt", "w") or die("Unable to open file!");
$txt = $yourbrowser; // adds the variale $yourbrowser to the variable $txt
fwrite($myfile, $txt). "<br>"; // adds that $txt above to the text doc
$txt = $_SESSION['screen_width']; // adds the screen width to the variable $txt
fwrite($myfile, $txt). "<br>"; // adds that $txt above to the text doc
$txt = $_SESSION['screen_height']; // adds the screen height to the variable $txt
fwrite($myfile, $txt). "<br>"; // adds that $txt above to the text doc
fclose($myfile); //closes file
?>

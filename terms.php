<!DOCTYPE html>
<html>
<head>
	<title>Terms & Conditions</title>
	<meta name="author" content="Sanjit Juneja" >
	<style type="text/css">
	body { background-color: #161616;
				 color: #009E60;
				 text-align: center;
	}
	a:link, a:visited {
	  background-color: transparent;
	  color: #009E60;
	  padding: 15px 25px;
	  text-align: right;
	  text-decoration: none;
	  display: inline-block;
	}

	a:hover, a:active {
	  background-color: #009E60;
		text-align: right;
		color: white;
	}
	</style>
</head>
<body>
<?php
   // ----------------------------------------------------------------------------------------------------------------------
	// >>>>>>>> START code to check that user is logged in   <<<<<<<<<<
	$LOGIN_PAGE_URL = "Login.php";  // YOU SHOULD DO THIS --- update this with the url of your login page.
	session_start();  // turn on the "session" - the server is storing information about this browser session for this user.

	if (isset($_SESSION['user_id'])) // 'user_id' is the piece of information we saved on the login page...
	{
		$user_id = $_SESSION['user_id']; // ... and we can use it in PHP queries for this user!
		$username = $_SESSION['username'];
	}
	else
	{
		header("Location:".$LOGIN_PAGE_URL ); // jump NOW to the login page.
	}
	// >>>>>>>> END code to check that user is logged in   <<<<<<<<<<
	// if the user isn't logged in, then they won't get here....
	// ----------------------------------------------------------------------------------------------------------------------
?>
<h3>
<span style="float:left"><a href="home.php">POPULAR STOCKS</a></span>
<span style="float:right">
<?php
echo("<a href='$LOGIN_PAGE_URL?command=logout'>Log out: $username</a>");
?>
</span>
<span style="float:right"><a href="terms.php">Terms & Conditions</a></span>
<span style="float:right"><a href="stocks.php">Stocks</a></span>
</h3>
<br />
<br />
<br />
<h1>House Rules & Terms</h1>
<br />
<br />
<p><h2>
	Dear User,
</h2></p>
<p><h2>
	We appreciate your active use on our network. We hope you enjoy it; however, it is important to understand that Popular Stocks is not responsible in any way about the future of these stocks or any individual investor's success or failure. The comments are used to get a sense of the people's opinion. Commenting should also only be used to talk about a certian stock and should not be used to hurt anyone else. Please refrain from using derogotary terms or insulting others. Thanks.
</h2></p>
<p><h2>
  Sincerely, Popular Stocks
</h2></p>
</body>
</html>

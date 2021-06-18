<!DOCTYPE html>
<html>
<head>
<title>Login Screen</title>
</head>
<style type="text/css">
body { background-color: #161616;
			 color: #009E60;
}
a:link, a:visited {
  background-color: transparent;
  color: #009E60;
  padding: 15px 25px;
  text-align: left;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: #009E60;
	color: white;
}
</style>
<?php
	require("connection.php");  // YOU SHOULD DO THIS --> update this to the path for your connector.php file.
	session_start(); // this turns on the "session" tracker - it can store info on the server about this browser session for this user.
	$FIRST_PAGE_LOGIN = "home.php";  // YOU SHOULD DO THIS --> update this with the page you would like to go to once the user logs in.

	// --------------------------------------------------------------- User just filled in user fields and clicked 'login' button, and we are revisiting this page.
	echo("<h4>");
	if (isset($_REQUEST['command']) and $_REQUEST['command']=="login")
	{
		// find what the user typed in....
		$username = $_REQUEST['username'];
		$password = $_REQUEST['pwd'];

		// count how many users have this username.
		$count_query = "SELECT count(*) as total FROM users WHERE username = '$username';";
		$count_response = mysqli_query($con,$count_query);
		$num_found = mysqli_fetch_assoc($count_response)['total'];
		if ($num_found ==0)
		{
			echo("Incorrect Username or Password");	// Note: same message as if we had a bad password, so as not to give hackers a clue....
		}
		else
		{	// find what the database says about this user
			$query = "SELECT password, user_id, is_validated FROM users WHERE username = '$username';";
			$response = mysqli_query($con,$query);
			if ($response != false)
			{
				$rows = mysqli_fetch_array($response);
				$is_validated = $rows['is_validated'];  // is_validated: has the user clicked the link in his/her email?
				if ($is_validated)
				{
					$encrypted_actual = $rows['password'];  // the encrypted version of the password, stored in database
					$id = $rows['user_id'];                 // the id of the user with this username

					$encrypted_given = md5($password);      // using "md5" to apply encryption to the password user typed in.

					if ($encrypted_actual == $encrypted_given)
					{
						echo("Good password."); // probably won't get to see this...
						$_SESSION['user_id'] = $id;	 // store the user id on server for this browser session for this user.
						$_SESSION['username'] = $username;
						                            //     This is how other pages will know we are logged in!

						header("Location:".$FIRST_PAGE_LOGIN); // Jump NOW to the first page of your site!
					}
					else
					{
						echo ("Incorrect Username or Password");   // Wah-wah-waaaaah
						// Note: this is exactly the same message as if we didn't have a matching username.
						//        we don't want to give a hacker a clue that s/he has a good username from a guess.
					}
				}
				else
				{
					echo("This account is not yet activated. Check the spam folder in your email for a link to activate this account!");
				}
			}
			else
			{
				echo ("Problem with query: $query"); 
			}
		}
	}
	// --------------------------------------------------------------- User just clicked "Logout" on another page....
	elseif (isset($_REQUEST['command']) and $_REQUEST['command']=="logout")
	{
		session_destroy(); // delete the information stored on the server about this browser session for this user - so other pages won't be
		                   //            able to access user_id variable and will send us back to this page.
	}
	echo("</h4>");
?>
<h3>
	<a href="home.php">POPULAR STOCKS</a>
	<span style="float:right;"><a href="new_account.php">Sign Up</a></span>
</h3>
<h1>
<form type='post' action=''>
<table style="margin-left: auto; margin-right: auto; background-color: #161616">
	<tr><th colspan="2"><h1>LOGIN TO POPULAR STOCKS</h1></th></tr>
	<tr><td>Username</td>
	    <td><input type='text' id='username' name='username' width='32' /></td>
	</tr>
	<tr><td>Password</td>
		 <td><input type='password' id='pwd' name='pwd' width='32' /></td>
	</tr>
	<tr><th colspan='2'><input type='submit' name='command' value='login' />
							  <input type='reset' value='reset' /></th>
	</tr>
</table>
</form>
</h1>
</body>
</html>

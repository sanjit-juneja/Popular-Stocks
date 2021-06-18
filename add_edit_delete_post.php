<!DOCTYPE html>
<html>
<head>
	<title>Changing Posts</title>
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
<br />

<?php
	echo('<h3>');
	require("connection.php");
	$command = $_REQUEST['command'];
	$market = $_REQUEST['market'];
	$stock_name = $_REQUEST['stock_name'];
	if ($command == 'Add')
	{
			echo("<form method = 'post' action = 'stock.php?market=$market&stock_name=$stock_name'>");

            echo('<input type="checkbox" name="anonymous" value="Anonymous">');
			echo('<table>');
			echo('<tr><td>Post</td><td><input type="text" name="post" /></td></tr>');
			echo('<tr><td>Prediction</td><td><select name="future">');
			echo('
									<option value="1" SELECTED>Bullish</option>
									<option value="0">Bearish</option>
					</select></td></tr>');
			echo('</table>');
			echo('<input type="submit" name="command" value="Cancel" />
					<input type="submit" name="command" value="Add" />
					</form>');
	}
	elseif (ISSET($_REQUEST['selection']))
	{
		$post_id = $_REQUEST['selection'];
		$command = $_REQUEST['command'];
		$query = "SELECT * FROM social WHERE post_id = $post_id ;";
		$query_result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($query_result);

		$post_username = $row['username'];
		$stock = $row['stock'];
		$post = $row['post'];
		$future = $row['future'];
		
		$query = "SELECT users_posts FROM social WHERE username = $username ;";
		$query_result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($query_result);

		if ($post_username == $username or in_array($row, $post_id))
		{
			if ($command == "Delete")
			{
				echo("<form method ='post' action= 'stock.php?market=$market&stock_name=$stock_name'>");

				echo("<input type = 'hidden' name='post_id_to_delete' value=$post_id>");
				echo("Do you really want to delete the post: $post");
				echo("<input type='submit' name='command' value = 'Cancel'>
				      <input type='submit' name='command' value = 'Yes, Delete'>");
				echo("</form>");
			}
			if ($command == 'Edit')
			{
			  echo("<form method = 'post' action = 'stock.php?market=$market&stock_name=$stock_name'>");
				echo("<input type = 'hidden' name='post_id_to_change' value=$post_id>");

				echo('<table>');
				echo('<tr><td>post</td><td><input type="text" name="post" value="'.$post.'"/></td></tr>');
				if ($future == 1)
				{
				echo('<tr><td>Prediction</td><td><select name="future">');
				echo('
										<option value="1" SELECTED>Bullish</option>
										<option value="0">Bearish</option>
						</select></td></tr>');
				}
				else
				{
					echo('<tr><td>Prediction</td><td><select name="future">');
					echo('
											<option value="1">Bullish</option>
											<option value="0" SELECTED>Bearish</option>
							</select></td></tr>');
				}
				echo('</table>');
				echo('<input type="submit" name="command" value="Cancel" />
						<input type="submit" name="command" value="Change" />
						</form>');
			}
		}
		else
		{
			echo("Good Try. You can only edit or delete your own posts!<br />
						<a href='stock.php?market=$market&stock_name=$stock_name'>Return</a>");
		}
	}
	else
	{
		echo("You need to select a post to delete or edit it!<br />
					<a href='stock.php?market=$market&stock_name=$stock_name'>Return</a>");
	}
	echo('</h3>');
?>
</body>
</html>

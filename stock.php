<!DOCTYPE html>
<html>
<head>
	<title>Stock</title>
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
	table { width: 100%;
					padding: 1px;
					border-spacing: 10px;
				}
	td, th {border: 1px black;
				}
	tr { background-color: #161616;
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
<?php
$market = $_REQUEST['market'];
$stock_name = $_REQUEST['stock_name'];
echo("<h1>$stock_name Graph</h1>");
require("connection.php");
?>
<br />
<br />
<br />
<?php
echo("
<!-- TradingView Widget BEGIN -->
<div class='tradingview-widget-container'>
  <div id='tradingview_7f7e9'></div>
  <div class='tradingview-widget-copyright'><a href='https://www.tradingview.com/symbols/$market-$stock_name/' rel='noopener' target='_blank'><span class='blue-text'>$stock_name Chart</span></a> by TradingView</div>
  <script type='text/javascript' src='https://s3.tradingview.com/tv.js'></script>
  <script type='text/javascript'>
  new TradingView.widget(
  {
  'width': 980,
  'height': 610,
  'symbol': '$market:$stock_name',
  'interval': 'D',
  'timezone': 'Etc/UTC',
  'theme': 'Light',
  'style': '1',
  'locale': 'en',
  'toolbar_bg': '#f1f3f6',
  'enable_publishing': false,
  'allow_symbol_change': true,
  'container_id': 'tradingview_7f7e9'
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
");
?>
<br />
<br />
<br />
<?php
	if (isset($_REQUEST['command']))
	{
		 $command = $_REQUEST['command'];
	}
	else
	{
		$command = "none";
	}

	if ($command == "Add")
	{
		$username_to_add = $username;
		$stock_to_add = "$stock_name";
		$anonymous = $_REQUEST['anonymous'];
		$post_to_add = $_REQUEST['post'];
		$future_to_add = $_REQUEST['future'];
		
		if ($anonymous == 1) {
		    $add_query = "INSERT INTO social (username,encrypted_username,stock,post,future) VALUES
									 ('anonymous','md5($username)','$stock_to_add','$post_to_add','$future_to_add');";
		} else {
		    $add_query = "INSERT INTO social (username,stock,post,future) VALUES
									 ('$username_to_add','$stock_to_add','$post_to_add','$future_to_add');";
		}
		
		$add_result = mysqli_query($con,$add_query);
		if ($add_result == true)
		{
			echo("Added.");
		}
	}
	elseif ($command == "Yes, Delete")
	{
		$post_id_to_delete = $_REQUEST['post_id_to_delete'];

		$delete_query = "DELETE FROM social WHERE post_id = $post_id_to_delete;";
		$delte_result = mysqli_query($con,$delete_query);
		if ($delte_result == true)
		{
			echo("Deleted.<br />");
		}
	}

	elseif($command == "Change")
	{
		$post_id = $_REQUEST['post_id_to_change'];
		$post_to_change = $_REQUEST['post'];
		$future_to_change = $_REQUEST['future'];

		$change_query = "UPDATE social SET post = '$post_to_change', future = '$future_to_change' WHERE post_id = $post_id;";

		$change_result = mysqli_query($con,$change_query);
		if ($change_result == true)
		{
			echo("Updated.<br />");
		}
	}
?>
<h1>Overall Vote</h1>
<?php
$query_bullish = "SELECT * FROM social WHERE (future = '1') AND (stock = '$stock_name');";
$query_bullish_result = mysqli_query($con,$query_bullish);
$bullish_counter = mysqli_num_rows($query_bullish_result);

$query_bearish = "SELECT * FROM social WHERE (future = '0') AND (stock = '$stock_name');";
$query_bearish_result = mysqli_query($con,$query_bearish);
$bearish_counter = mysqli_num_rows($query_bearish_result);
echo("<h1>");
echo("<img src='bullish.png' width = '50' height = '50'>: $bullish_counter");
echo("<br />");
echo("<br />");
echo("<img src='bearish.png' width = '50' height = '50'>: $bearish_counter");
echo("</h1>");
$query = "SELECT * FROM social WHERE stock = '$stock_name';";
$query_result = mysqli_query($con,$query);
echo("<br />");
echo("<h1>Comments</h1>");

if (mysqli_num_rows($query_result) == 0)
{
	echo("Be the First to Comment!");
	echo("<br />");
	echo ("<form method = 'post' action = 'add_edit_delete_post.php'>");
	echo ("<input type ='hidden' name='market' value='$market'>");
	echo ("<input type ='hidden' name='stock_name' value='$stock_name'>");
	echo ("<table><tr><th>Select</th><th>Username</th><th>Comment</th><th>Prediction</th></tr>");
	while ($row = mysqli_fetch_array($query_result))
	{
		$post_id = $row['post_id'];
		$username = $row['username'];
		$post = $row['post'];
		$future = $row['future'];

		echo("<tr><td><input type='radio' name='selection' value = '$post_id'></td><td>$username</td><td>$post</td><td>$futue</td></tr>");
	}
	echo ("</table>");
	echo ("<input type = 'submit' name = 'command' value = 'Add' /><input type = 'submit' name = 'command' value = 'Delete' />
					<input type = 'submit' name = 'command' value = 'Edit' />");
	echo ("</form>");
}
else
{
	echo ("<form method = 'post' action = 'add_edit_delete_post.php'>");
	echo ("<input type ='hidden' name='market' value='$market'>");
	echo ("<input type ='hidden' name='stock_name' value='$stock_name'>");
	echo ("<table><tr><th>Select</th><th>Username</th><th>Comment</th><th>Prediction</th></tr>");
	while ($row = mysqli_fetch_array($query_result))
	{
		$post_id = $row['post_id'];
		$username = $row['username'];
		$encrypted_username = $row['encrypted_username'];
		$post = $row['post'];
		$future = $row['future'];
		if ($future == 1)
		{
			$prediction = "Bullish";
		}
		else
		{
			$prediction = "Bearish";
		}
        if ($username == $_SESSION['username'] or $encrypted_username = md5($_SESSION['username'])) {
            echo("<tr><td><input type='radio' name='selection' value = '$post_id'></td><td>$username</td><td>$post</td><td>$prediction</td></tr>");
        }
        else {
            echo("<tr><td>$post_id</td><td>$username</td><td>$post</td><td>$prediction</td></tr>");
        }
	}
	echo ("</table>");
	echo ("<input type = 'submit' name = 'command' value = 'Add' /><input type = 'submit' name = 'command' value = 'Delete' />
					<input type = 'submit' name = 'command' value = 'Edit' />");
	echo ("</form>");
}
?>

</body>
</html>

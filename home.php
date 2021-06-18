<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
<img src="welcome.jpg" width = "1444" height = "600">
<h2><p>SERVICES</p></h2>
<p><h2>
	Hey, welcome to Popular Stocks. We offer real-time updating charts of several stocks in the DOW. Located in the Stocks page, comments below each graph from other users are visible to everyone logged in. Make sure to comment on your own. Hope you like it.
</h2></p>
<h2><p>THE CURRENT DOW</p></h2>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_1d159"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NYSE-DOW/" rel="noopener" target="_blank"><span class="blue-text">DOW Chart</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": 980,
  "height": 610,
  "symbol": "NYSE:DOW",
  "interval": "D",
  "timezone": "Etc/UTC",
  "theme": "Light",
  "style": "1",
  "locale": "en",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "allow_symbol_change": true,
  "container_id": "tradingview_1d159"
}
  );
  </script>
</div>


</body>
</html>

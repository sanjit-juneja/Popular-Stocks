<!DOCTYPE html>
<html>
<head>
	<title>Stocks</title>
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
<h1>DOW STOCKS</h1>
<h2>Select any of the 30 stocks below to view the stock and comment on it's future!</h2>
<br />
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=AXP">AXP (AMERICAN EXPRESS CO)</a>
<br />
<br />
<a href="stock.php?market=NASDAQ&stock_name=AAPL">AAPL (APPLE INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=BA">BA (Boeing Co)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=CAT">CAT (CATTERPILLAR INC)</a>
<br />
<br />
<a href="stock.php?market=NASDAQ&stock_name=CSCO">CISCO (CISCO SYSTEMS INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=CVX">CVX (CHEVRON CORP)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=DOW">DOW (DOW INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=XOM">XOM (EXXON MOBIL CORP)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=GS">GS (GOLDEN SACHS GROUP INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=HD">HD (HOME DEPOT)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=IBM">IBM (INTERNATIONAL BUISNESS MACHINES CORP)</a>
<br />
<br />
<a href="stock.php?market=NASDAQ&stock_name=INTC">INTC (INTEL CORP)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=JNJ">JNJ (JOHNSON & JOHNSON)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=KO">KO (COCA-COLA CO)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=JPM">JPM (JPMORGAN CHASE & CO)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=MCD">MCD (MCDONALD'S CORP)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=MMM">MMM (3M CO)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=MRK">MRK (MERK & CO INC)</a>
<br />
<br />
<a href="stock.php?market=NASDAQ&stock_name=MSFT">MSFT (MICROSOFT CORP)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=NKE">NKE (NIKE INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=PFE">PFE (PFIZER INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=PG">PG (PROCTOR & GAMBLE INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=TRV">TRV (TRAVELERS COMPANIES INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=UNH">UNH (UNITEDHEALTH GROUP INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=UTX">UTX (UNITED TECHNOLOGIES CORP)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=VZ">VZ (VERIZON COMMUNICATIONS INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=V">V (VISA INC)</a>
<br />
<br />
<a href="stock.php?market=NASDAQ&stock_name=WBA">WBA (WALGREENS BOOTS ALLIANCE INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=WMT">WMT (WALMART INC)</a>
<br />
<br />
<a href="stock.php?market=NYSE&stock_name=DIS">DIS (WALT DISNEY CO)</a>
</body>
</html>

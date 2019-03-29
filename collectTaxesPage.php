<?php

$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_COOKIE["NationCookie"])) {
	$nationCookie = $_COOKIE["NationCookie"];
} else {
	echo "<script>location.href='login.html'</script>";
}
$sql = "
	SELECT nationId FROM Session WHERE sessionCookie = '$nationCookie'
";
if(NULL === $nation = $conn->query($sql)->fetch_assoc()) {
	echo "<script>location.href='login.html'</script>";
}
$nationId = $nation['nationId'];
$sql = "
	SELECT 
	population,
	citizenIncome,
	taxRate,
	lastTaxCollection
	FROM Nation 
	WHERE 
	nationId = '$nationId'
";
$taxInfo = $conn->query($sql)->fetch_assoc();
$currentTime = new DateTime();
$lastTaxCollection = new DateTime($taxInfo['lastTaxCollection']);
$daysSinceLastTaxCollection = $currentTime->diff($lastTaxCollection)->days;
$citizenIncome = number_format(floatval($taxInfo['citizenIncome']), 2,'.', ',');
$population = $taxInfo['population'];
$taxRate = $taxInfo['taxRate'];
$citizenTaxPay = number_format(floatval((float)$taxRate / 100.0 * (float)$citizenIncome), 2,'.', ',');
$citizenIncome = '$'.number_format(floatval($taxInfo['citizenIncome']), 2,'.', ',');
$totalCollection = '$'.number_format(floatval(intval((float)$daysSinceLastTaxCollection * (float)$population * (float)$citizenTaxPay)), 2,'.', ',');
$citizenTaxPay = '$'.$citizenTaxPay;
echo "
	<heac>
	<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"icons/mainFavicon.png\">
		<title>Nation Game</title>
	</heac>
<style>
	body{
			background-image:url('images/homepageBackground.jpg');
			background-repeat: no-repeat;
			background-size: cover;
	}
	h1{
		margin-top:100px;
		text-align: center;
	}
	table{
			width:33%;
			display:table;
			margin-left: auto;
			margin-right: auto;
			margin-top: 50px;
			border-collapse: collapse;
			height:50%;
    } 
	td {
			border: 1px solid blue;
			width:100%;
			border-collapse: collapse;
			padding: 10px;
			font-size:24px;
			font-weight:bold;
	}
	div{
		margin-top:25px;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		width:50%;
	}
	#mainDiv{
		background:white;
		opacity:.75;
	}
</style>

<script>
	function runCollectTaxesScript(){
		var oReq = new XMLHttpRequest(); //New request object
		oReq.onload = function() {
			location.href='nationHomePage.php';
		};
		oReq.open('get', 'collectTaxesScript.php', true);
		oReq.send();
	}
</script>
<a href = 'nationHomePage.php'><img src='images/tank.png' width='140px' height='60px' ></a>
<div id='mainDiv'>
	<h1>Collect Taxes</h1>
	<table>
		<tr>
			<td>
				You have {$population} tax paying citizens
			</td>
		</tr>
		<tr>
			<td>
				Your citizens each make {$citizenIncome} per day
			</td>
		</tr>
		<tr>
			<td>
				Your tax rate is {$taxRate}%
			</td>
		</tr>
		<tr>
			<td>
				Your citizens each pay {$citizenTaxPay} in taxes every day
			</td>
		</tr>
		<tr>
			<td>
				You haven't collected taxes in {$daysSinceLastTaxCollection} days
			</td>
		</tr>
		<tr>
			<td>
				Your total collection is {$totalCollection}
			</td>
		</tr>
	</table>
<div>
";
if ($daysSinceLastTaxCollection > 0) {
	echo "
	<div>
		<button onclick='runCollectTaxesScript()'>Collect Taxes</button>
	</div>
	";
}
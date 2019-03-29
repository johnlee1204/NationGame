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
	infrastructure,
	soldiers,
	tanks,
	lastBillPayment
	FROM Nation 
	WHERE 
	nationId = '$nationId'
";
$taxInfo = $conn->query($sql)->fetch_assoc();
$currentTime = new DateTime();
$lastBillPayment = new DateTime($taxInfo['lastBillPayment']);
$daysSinceLastBillPayment = $currentTime->diff($lastBillPayment)->days;
$soldiers = $taxInfo['soldiers'];
$infrastructure = $taxInfo['infrastructure'];
$tanks = $taxInfo['tanks'];
$totalPayment = '$'.number_format(floatval(intval($daysSinceLastBillPayment * (($soldiers*10) + ($tanks*50) + ($infrastructure*100)))), 2,'.', ',');
echo "
	<head>
		<title>Nation Game</title>
	</head>
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
	function runPayBillsScript(){
		var oReq = new XMLHttpRequest(); //New request object
		oReq.onload = function() {
			location.href='nationHomePage.php';
		};
		oReq.open('get', 'payBillsScript.php', true);
		oReq.send();
	}
</script>
<a href = 'nationHomePage.php'><img src='images/tank.png' width='140px' height='60px' ></a>
<div id='mainDiv'>
	<h1>Pay Bills</h1>
	<table>
		<tr>
			<td>
				You have {$infrastructure} infrastructure costing $100 a day each
			</td>
		</tr>
		<tr>
			<td>
				You have {$soldiers} soldiers costing $10 a day each
			</td>
		</tr>
		<tr>
			<td>
				You have {$tanks} tanks costing $50 a day each
			</td>
		</tr>
		<tr>
			<td>
				You haven't paid bills in {$daysSinceLastBillPayment} days
			</td>
		</tr>
		<tr>
			<td>
				Your total payment is {$totalPayment}
			</td>
		</tr>
	</table>
</div>
";
if ($daysSinceLastBillPayment > 0) {
	echo "
	<div>
		<button onclick='runPayBillsScript()'>Pay Bills</button>
	</div>
	";
}
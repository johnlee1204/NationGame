<?php
header("login.html");
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
$nationName = $_POST['nationName'];
$leaderName = $_POST['leaderName'];
$email = $_POST['email'];
$password = $_POST['password'];
$capitalCity = $_POST['capitalCity'];
$money = 1000000;
$biography = $_POST['biography'];
$population = 5000;
$ethnicity = $_POST['ethnicity'];
$religion = $_POST['religion'];
$government = $_POST['government'];
$happiness = 5;
$age = 0;
$technologyLevel = 10;
$land = 25;
$infrastructure = 10;
$soldiers = 100;
$tanks = 0;

$taxRate = 15;
$lastTaxCollection = new DateTime();
$lastTaxCollection->modify('-1 day');
$lastBillPayment = new DateTime();
$lastBillPayment->modify('-1 day');

$lastTaxCollection=$lastTaxCollection->format('Y-m-d');
$lastBillPayment=$lastBillPayment->format('Y-m-d');
$ethnicity = $_POST['ethnicity'];
if($_POST['1']==="Yes"){
	$population+=500;
}
else{
	$population-=500;
}
if($_POST['2']==="capitalist"){
	$money+=500000;
	$soldiers-=50;
	$taxRate-=5;
}
else{
	$money-=500000;
	$soldiers+=400;
	$taxRate+=5;
}
if($_POST['3']==="Yes"){
	$happiness+=2;
}
else{
	$happiness-=1;
}
$power = $population+$age+$infrastructure+$soldiers+$tanks+$technologyLevel+$land;
$citizenIncome = $happiness*10;
//ALTER TABLE Units AUTO_INCREMENT = 0
$sql = "INSERT INTO Nation(
	nationName,
	leaderName,
	email,
	password,
	capitalCity,
	money,
	biography,
	population,
	citizenIncome,
	taxRate,
	lastTaxCollection,
	lastBillPayment,
	ethnicity,
	religion,
	government,
	happiness,
	age,
	power,
	technologyLevel,
	land,
	infrastructure,
	soldiers,
	tanks
	)
	VALUES(
	'$nationName',
	'$leaderName',
	'$email',
	'$password',
	'$capitalCity',
	'$money',
	'$biography',
	'$population',
	'$citizenIncome',
	'$taxRate',
	'$lastTaxCollection',
	'$lastBillPayment',
	'$ethnicity',
	'$religion',
	'$government',
	'$happiness',
	'$age',
	'$power',
	'$technologyLevel',
	'$land',
	'$infrastructure',
	'$soldiers',
	'$tanks'
	)
	";
$conn->query($sql);
echo "<script>location.href='login.html'</script>";
exit();
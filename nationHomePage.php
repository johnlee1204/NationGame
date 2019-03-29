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
	biography,
	nationName,
	leaderName,
	capitalCity,
	government,
	religion,
	population,
	citizenIncome,
	taxRate,
	money,
	ethnicity,
	happiness,
	age,
	power,
	technologyLevel,
	land,
	infrastructure,
	soldiers,
	tanks
	FROM Nation 
	WHERE 
	nationId = '$nationId'
";

$nationInfo = $conn->query($sql)->fetch_assoc();

if (!$nationInfo) {
    echo "<script>location.href='login.html'</script>";
}

$nationInfo['population'] = number_format(floatval($nationInfo['population']), 0, '.', ',');
$nationInfo['power'] = number_format(floatval($nationInfo['power']), 0, '.', ',');
$nationInfo['age'] = number_format(floatval($nationInfo['age']), 0, '.', ',');
$nationInfo['technologyLevel'] = number_format(floatval($nationInfo['technologyLevel']), 0, '.', ',');
$nationInfo['soldiers'] = number_format(floatval($nationInfo['soldiers']), 0, '.', ',');
$nationInfo['tanks'] = number_format(floatval($nationInfo['tanks']), 0, '.', ',');
$nationInfo['citizenIncome'] = '$' . number_format(floatval($nationInfo['citizenIncome']), 2, '.', ',');
$nationInfo['land'] = number_format(floatval($nationInfo['land']), 0, '.', ',');
$nationInfo['infrastructure'] = number_format(floatval($nationInfo['infrastructure']), 0, '.', ',');
$nationInfo['money'] = '$' . number_format(floatval($nationInfo['money']), 2, '.', ',');


$nationInfo = array_values($nationInfo);
$tableRowTitle = array(
    'Nation Bio:',
    'Nation Name:',
    'Leader Name:',
    'Capital City:',
    'Government:',
    'Religion:',
    'Population:',
    'Citizen Income',
    'Tax Rate',
    'Money',
    'Ethnicity:',
    'Happiness:',
    'Nation Age:',
    'Power:',
    'Technology:',
    'Land:',
    'Infrastructure:',
    'Soldiers:',
    'Tanks:'
);
echo ">
		<title>Nation Game</title>
	</heac>
    <style>
		a{
			color:blue;
			font-size:24px;
		}
		body{
			background: url('images/homepageBackground.jpg') no-repeat;
			background-size: cover;
		}
        table{
			width:100%;
			display:table;
			border-collapse: collapse;
			height:100%;
        } 
        td {
				border: 1px solid blue;
				width:100%;
				height:100%;
				border-collapse: collapse;
				padding: 10px;
				font-size:24px;
				
		}
		.firstTd{
			width:25%;
		}
		.secondTd{
			width:100%;
		}
		h1{
			font-size:40px;
			color:blue;
			text-align: center;
			margin-top:100px;
		}
		#mainDiv{
			width:80vw;
			height: 1000px;
			margin-left: auto;
			margin-right: auto;
			border: 2px solid blue;
			background:white;
			opacity:.75;
		}
		#leftDiv{
			display:inline-block;
			text-align: center;
			width:25%;
			float:left;
			height: 100%;
			padding-top:50px;
		}
		#rightDiv{
			display:inline-block;
			text-align: center;
			width:25%;
			float:left;
			height: 100%;
			padding-top:50px;
		}
		#centerDiv{
			display:inline-block;
			width:50%;
			float:left;
			height: 100%;
		}
		
    </style>
    ";
echo "
<div id='mainDiv'>
	<div id='leftDiv'>
		<a href='collectTaxesPage.php'>Collect Taxes</a><br>
		<a href='payBillsPage.php'>Pay Bills</a><br>
	</div>
	<div id='centerDiv'>
	<table>
";
for ($i = 0; $i < count($tableRowTitle); $i++) {
    echo "
		<tr>
            <td class='firstTd'>
                <strong>{$tableRowTitle[$i]}</strong>
            </td>
            <td class='secondTd'>
                <strong>{$nationInfo[$i]}</strong>
            </td>
        </tr>
	";
}
echo "</table>
	</div>
		<div id='rightDiv'>
			<a href='purchaseSoldiersPage.php'>Purchase Soldiers</a><br>
			<a href='buyTanks.php'>Purchase Tanks</a><br>
			<a href='buyInfrastructure.php'>Purchase Infrastructure</a><br>
		</div>
</div>
";
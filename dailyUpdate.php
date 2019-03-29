<?php
/**
 * Created by PhpStorm.
 * User: jlee
 * Date: 12/7/2018
 * Time: 10:04 AM
 */
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT 
		id,
		population,
		age,
		land,
		power,
		infrastructure,
		happiness,
		citizenIncome,
		soldiers,
		tanks,
		technologyLevel
		FROM Nation
		";
$nationsData = $conn->query($sql) or die($conn->error);
$nations = array();
while ($nationsData && $row = $nationsData->fetch_assoc()) {
	$nations[] = $row;
}
foreach ($nations as $nation){
	$id = $nation['id'];
	$population = $nation['population']+=25;
	$age = ++$nation['age'];
	$land= $nation['land']+=10;
	$power = $nation['power'] = $nation['population']+$nation['age']+$nation['infrastructure']+$nation['soldiers']+$nation['tanks']+$nation['technologyLevel']+$nation['land'];
	$citizenIncome = $nation['citizenIncome'] = $nation['happiness']*10;
	$sql = "
			UPDATE Nation
			SET
			population = '$population',
			age = '$age',
			land = '$land',
			power = '$power',
			citizenIncome = '$citizenIncome'
			WHERE 
			id = '$id'
	";
	$conn->query($sql);
}
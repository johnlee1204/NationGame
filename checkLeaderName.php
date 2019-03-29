<?php
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
$leaderName = $_GET['leaderName'];
$sql = "
SELECT COUNT(leaderName)
FROM Nation
WHERE leaderName = '$leaderName' 
";
$count = $conn->query($sql)->fetch_array()[0];
if($count>0){
	echo json_encode(false);
}
else {
	echo json_encode(true);
}

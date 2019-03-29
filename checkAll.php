<?php
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
$totalCount = 0;
$email = $_GET['email'];
$sql = "
SELECT COUNT(email)
FROM Nation
WHERE email = '$email' 
";
$count = $conn->query($sql)->fetch_array()[0];
$totalCount+=$count;
$leaderName = $_GET['leaderName'];
$sql = "
SELECT COUNT(leaderName)
FROM Nation
WHERE leaderName = '$leaderName' 
";
$count = $conn->query($sql)->fetch_array()[0];
$totalCount+=$count;
$nationName = $_GET['nationName'];
$sql = "
SELECT COUNT(nationName)
FROM Nation
WHERE nationName = '$nationName' 
";
$count = $conn->query($sql)->fetch_array()[0];
$totalCount+=$count;
if($totalCount==0){
	echo json_encode(true);
}
else{
	echo json_encode(false);
}

<?php
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
$nationName = $_GET['nationName'];
$sql = "
SELECT COUNT(nationName)
FROM Nation
WHERE nationName = '$nationName' 
";
$count = $conn->query($sql)->fetch_array()[0];
if($count>0){
    echo json_encode(false);
}
else {
    echo json_encode(true);
}

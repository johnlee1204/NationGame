<?php
$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
$email = $_GET['email'];
$sql = "
SELECT COUNT(email)
FROM Nation
WHERE email = '$email' 
";
$count = $conn->query($sql)->fetch_array()[0];
if($count>0){
    echo json_encode(false);
}
else {
    echo json_encode(true);
}

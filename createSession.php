<?php
include_once('NationGameSession.php');
$email = $_POST['email'];
$userPassword = $_POST['password'];

$servername = "localhost";
$username = "johntheadmin";
$password = "Echo120499!";
$dbname = "nationgame";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->query("SELECT COUNT(nationId) num FROM Nation WHERE email = '$email' AND password = '$userPassword'")->fetch_assoc()['num'] !== '1') {
	echo "<script>location.href='login.html'</script>";
}
$sql = "
	SELECT
	nationId,
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
	email = '$email'
	AND 
	password = '$userPassword'
";
$nationInfo = $conn->query($sql)->fetch_assoc();
$nationId = $nationInfo['nationId'];
$sql = "
	DELETE FROM Session WHERE nationId = '$nationId'
";
$conn->query($sql);
$sessionCookie = NationGameSession::createSession();
$sql = "INSERT INTO Session (sessionCookie,nationId) VALUES ('$sessionCookie','$nationId')";
$conn->query($sql);
setcookie("NationCookie", $sessionCookie, time() + 3600);
echo "<script>location.href='nationHomePage.php'</script>";

<?php$servername = "localhost";$username = "johntheadmin";$password = "Echo120499!";$dbname = "nationgame";$conn = new mysqli($servername, $username, $password, $dbname);if (isset($_COOKIE["NationCookie"])) {	$nationCookie = $_COOKIE["NationCookie"];} else {	echo "<script>location.href='login.html'</script>";}$sql = "	SELECT nationId FROM Session WHERE sessionCookie = '$nationCookie'";if(NULL === $nation = $conn->query($sql)->fetch_assoc()) {	echo "<script>location.href='login.html'</script>";}$nationId = $nation['nationId'];$sql = "	SELECT 	infrastructure,	soldiers,	tanks,	lastBillPayment,	money	FROM Nation 	WHERE 	nationId = '$nationId'";$billInfo = $conn->query($sql)->fetch_assoc();$money = $billInfo['money'];$currentTime = new DateTime();$lastBillPayment = new DateTime($billInfo['lastBillPayment']);$daysSinceLastBillPayment = $currentTime->diff($lastBillPayment)->days;$soldiers = $billInfo['soldiers'];$infrastructure = $billInfo['infrastructure'];$tanks = $billInfo['tanks'];$totalPayment = intval($daysSinceLastBillPayment * (($soldiers*10) + ($tanks*50) + ($infrastructure*100)));$moneyAfterPayment = $money-$totalPayment;$currentTime = $currentTime->format('Y-m-d');$sql = "	UPDATE Nation	SET	money = '$moneyAfterPayment',	lastBillPayment = '$currentTime'	WHERE	nationId = '$nationId'";$conn->query($sql);
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
    population,
    money,
    soldiers
    FROM Nation
    WHERE 
    nationId = '$nationId'
";
$nationInfo = $conn->query($sql)->fetch_assoc();
$soldiers = number_format(floatval($nationInfo['soldiers']), 0,'.', ',');
$money = number_format(floatval($nationInfo['money']), 2,'.', ',');
echo "
    <style>
        body{
			background: url('images/homepageBackground.jpg') no-repeat;
			background-size: cover;
		}
        table{
            margin-top:150px;
            margin-left: auto;
            margin-right: auto;
			width:33%;
			display:table;
			border-collapse: collapse;
			height:50%;
			background: white;
			opacity:.75;
        } 
        td {
				border: 1px solid blue;
				border-collapse: collapse;
				padding: 10px;
				font-size:24px;
				
		}
		.firstTd{
			width:25%;
		}
		.secondTd{
		
		}
			
    </style>
    <body>
    <script>
    	function completePurchase() {
    	    var soldierAmount = document.getElementById('soldiers').value;
    	}
	</script>
    <a href = 'nationHomePage.php'><img src='images/tank.png' width='140px' height='60px' ></a>
        <table>
            <tr>
                <td class='firstTd'>Current Soldiers:</td>
                <td class='secondTd'>$soldiers</td>
            </tr>
            <tr>
                <td>Money Available:</td>
                <td>$$money</td>
            </tr>
            <tr>
            	<td>Cost Per Soldier</td>
            	<td>$10.00</td>
			</tr>
            <tr>
            	<td>Number Of Soldiers To Purchase</td>
            	<td>
            		<input id='soldiers'  name='soldiers' placeholder='#' required>
            	</td>
            </tr>
        </table>
        <button onclick='completePurchase()'>Complete Purchase</button>
    </body>
";
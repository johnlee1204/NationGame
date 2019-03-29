<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/png" sizes="32x32" href="icons/mainFavicon.png">
		<title>Nation Game</title>
		<style>
            body{
                background-image:url('images/homepageBackground.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                padding:100px;
            }
			h1{
				text-align:center;
				font-size: 50px;
			}
			#centerDiv{
                display:block;
				margin-left:auto;
                margin-right:auto;
                //margin-top:100px;
				width: 50%;
                height: 100vh;
				border: 3px solid blue;
				padding: 10px;
                background:white;
                opacity:.75;
			}
		</style>
	</head>
	
	<body>
		<div id="centerDiv">
            <h1>Welcome To NationGame!</h1>
			<p>Welcome to Nation Game. This is a side project of programmer John Lee. Inspired by Cybernations and NationStates I hope people have fun with it.</p>
			<button onclick="location.href='createNation.html'">Create A Nation</button>
            <button onclick="location.href='login.html'">Sign In</button>
		</div>
	</body>
</html>
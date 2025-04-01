<?php
session_start();
include "connection.php";
if (isset($_SESSION['admin'])) {
	header("location: adminhome.php");
}
if (isset($_POST['password']))  {
	$password = mysqli_real_escape_string($conn , $_POST['password']);
	$adminpass = '$2y$10$8WkSLFcoaqhJUJoqjg3K8eWixJWswsICf7FTxehKmx8hpmIKYWqju';
	if (password_verify($password , $adminpass)) {
		$_SESSION['admin'] = "active";
		header("Location: adminhome.php");
	}
	else {
		echo  "<script> alert('wrong password');</script>";
	}
}


?>



<html>
	<head>
		<title>Brain_Bash</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style>
			.admin-page {
				min-height: 100vh;
				display: flex;
				flex-direction: column;
				background: linear-gradient(-45deg, #1a1a2e, #16213e, #0f3460, #1b2d45);
				background-size: 400% 400%;
				animation: gradientBG 15s ease infinite;
			}

			.admin-page main {
				display: flex;
				justify-content: center;
				align-items: center;
				flex: 1;
			}

			.admin-page main .container {
				background: rgba(255, 255, 255, 0.1);
				backdrop-filter: blur(10px);
				border-radius: 15px;
				width: 500px;
				height: 500px;
				padding: 20px;
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
				border: 1px solid rgba(255, 255, 255, 0.1);
			}

			.admin-page h2 {
				font-size: 1.5rem;
				margin: 0 0 20px 0;
				color: #fff;
				text-align: center;
				font-weight: 500;
			}

			.admin-page form {
				width: 100%;
				display: flex;
				flex-direction: column;
				align-items: center;
				gap: 20px;
			}

			.admin-page input[type="password"] {
				width: 70%;
				padding: 20px;
				margin-bottom: 15px;
				background: rgba(255, 255, 255, 0.07);
				border: 1px solid rgba(255, 255, 255, 0.1);
				border-radius: 8px;
				color: #fff;
				font-size: 1rem;
				text-align: center;
				transition: all 0.3s ease;
			}

			.admin-page input[type="password"]:focus {
				outline: none;
				border-color: rgba(255, 255, 255, 0.3);
				box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
			}

			.admin-page input[type="submit"],
            .admin-page .start {
                width: 150px;
                height: 45px;
                display: flex;
                justify-content: center;
                align-items: center;
                background: #4CAF50;
                font-weight: 600;
                color: white;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-size: 1rem;
                transition: all 0.3s ease;
                text-decoration: none;
                margin: 10px;
            }

            .admin-page input[type="submit"]:hover,
            .admin-page .start:hover {
                background: #45a049;
                transform: translateY(-2px);
            }

            .admin-page input[type="submit"]:active,
            .admin-page .start:active {
                transform: translateY(1px);
            }

			@keyframes gradientBG {
				0% { background-position: 0% 50%; }
				50% { background-position: 100% 50%; }
				100% { background-position: 0% 50%; }
			}
		</style>
	</head>

	<body class="admin-page">
		<header>
			<div class="container">
				<h1>Brain_Bash</h1>
				<a href="index.php" class="start">Home</a>

			</div>
		</header>

		<main>
		<div class="container">
				<h2>Enter Password</h2>
				<form method="POST" action="">
				<input type="password" name="password" required="" >
				<input type="submit" name="submit" value="send"> 

			</div>


		</main>

		<footer>
			<div class="container">
				Copyright @ Brain_Bash
			</div>
		</footer>

	</body>
</html>
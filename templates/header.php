<!DOCTYPE html>
<html>
<head>
	<title>Login Dan Register OOP</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
	<header>
		<h1>Belajar Auth Di SekolahCoding</h1>
		<nav>
		<?php if ( Session::exists('username')) { ?>
			<a href="logout.php">Logout</a>
		<?php }else{ ?>
			<a href="login.php">Login</a>
			<a href="register.php">Register</a>
		<?php  } ?>
			<a href="profile.php">Profile</a>
		</nav>
	</header>

<?php
require_once("db.php");
session_start();
$error='';
if(count($_POST)>0){
    if(!isset($_POST['email'][0])) die('You must enter your email.');
    if(!isset($_POST['password'][0])) die('You must enter your password.');
    if(strlen($error)==0){
		$stmt = $db->prepare('SELECT email FROM users WHERE email = ?');
		$stmt->execute([$_POST['email']]);
		$prevUser = $stmt->fetch();
		if($prevUser!=""){
			$error='This user is already registered.';
			echo $error;
		}
		if(strlen($error)==0){
			$addUser = $db->prepare('INSERT INTO users(email, password, firstName, lastName, isAdmin) VALUES (?, ?, ?, ?, ?)');
			if($_POST['adminPassword']==123123123){
				$addUser->execute([$_POST['email'],$_POST['password'],$_POST['firstName'],$_POST['lastName'],1]);
			}
			else{
				$addUser->execute([$_POST['email'],$_POST['password'],$_POST['firstName'],$_POST['lastName'],0]);
			}
            $stmt = $db->prepare('SELECT email FROM users WHERE email = ? AND password = ?');
		    $stmt->execute([$_POST['email'],$_POST['password']]);
		    $user = $stmt->fetch();
		    if($user!=""){
			    $_SESSION['email']=$user;
			    header('location: entity/index.php');
			    die();
		    }
        }
    }
}
?>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Sarabun:300,300i,400,400i,500,600,700,800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- main style css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <h2>Register for Karen Social</h2>
	<p>* for required fields</p><br>
    </head>
    <style>
        body{
            text-align:center;
        }
    </style>
    <body>
        <form method="POST">
            <label><h3>*Email</h3></label>
            <input name="email" type="email"/><br><br>
            <label><h3>*Password</h3></label>
            <input name="password" type="password"/><br><br>
			<label><h3>First Name</h3></label>
            <input name="firstName" type="firstName"/><br><br>
			<label><h3>Last Name</h3></label>
            <input name="lastName" type="lastName"/><br><br>
			<label><h3>Admin Password</h3></label>
            <input name="adminPassword" type="adminPassword"/><br><br>
            <button type="submit" class="btn btn-all">Sign Up</button>
        </form>
    </body>
</html>
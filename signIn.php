<?php
require_once("db.php");
session_start();
$error='';
if(count($_POST)>0){
    if(!isset($_POST['email'][0])) die('You must enter your email.');
    if(!isset($_POST['password'][0])) die('You must enter your password.');
    if(strlen($error)==0){
		$stmt = $db->prepare('SELECT email FROM users WHERE email = ? AND password = ?');
		$stmt->execute([$_POST['email'],$_POST['password']]);
		$user = $stmt->fetch();
		if($user!=""){
			$_SESSION['email']=$user;
			header('location: entity/index.php');
			die();
		}
		//start here next by checking to see if there was any value returned at all
		
        /*$fp=fopen('users.csv.php','r');
        while(!feof($fp)){
            $line=fgets($fp);
            $line=explode(';',trim($line));
            if(count($line)==2 && $_POST['email']==$line[0] && password_verify($_POST['password'],trim($line[1]))){
                fclose($fp);
                $_SESSION['email']=$line[0];
                header('location: entity/index.php');
                die();
            }
        }*/
        echo "Email or Password incorrect. Please try again.";
    }
}
?>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign In</title>
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
    <h2>Karen Social Sign In</h2><br>
    </head>
    <style>
        body{
            text-align:center;
        }
    </style>
    <body>
        <form method="POST">
            <div>
                <label><h3>Email</h3></label>
                <input name="email" type="email"/>
            </div><br>
            <div>
                <label><h3>Password</h3></label>
                <input name="password" type="password"/>
            </div><br>
            <div>    
                <button type="submit" class="btn btn-all">Sign In</button>
            </div>    
        </form>
    </body>
</html>
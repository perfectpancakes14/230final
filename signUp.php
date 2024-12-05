<?php
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
			break;
		}
		if(strlen($error)==0){
			//begin here by adding the email and password of the new user
			
        /*$fp=fopen('users.csv.php','r');
        while(!feof($fp)){
            $line=fgets($fp);
            $line=explode(';',$line);
            if(count($line)==2 && $_POST['email']==$line[0]){
                $error='This user is already registered.';
                echo $error;
                break;
            }    
        }
        fclose($fp);
        if(strlen($error)==0){
            $fp=fopen('users.csv.php','a+');
            fputs($fp,$_POST['email'].';'.password_hash($_POST['password'],PASSWORD_DEFAULT).PHP_EOL);
            fclose($fp);
            header('location: entity/index.php');
            die();
        }*/
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
    <h2>Register for Karen Social</h2><br>
    </head>
    <style>
        body{
            text-align:center;
        }
    </style>
    <body>
        <form method="POST">
            <label><h3>Email</h3></label>
            <input name="email" type="email"/><br><br>
            <label><h3>Password</h3></label>
            <input name="password" type="password"/>
            <br><br>
            <button type="submit" class="btn btn-all">Sign Up</button>
        </form>
    </body>
</html>
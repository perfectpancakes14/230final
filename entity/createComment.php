<?php
require_once("../db.php");
session_start();
$i = $_GET['post_id'];
$error='';

if(!isset($_SESSION['email']))
{
    header('location: ../index.php');
}

if(count($_POST)>0){
    $email = $_SESSION['email'];
    $stmt = $db->prepare('SELECT userID FROM users WHERE email = ?');
    $stmt->execute([$email[0]]);
    $userID = $stmt->fetch();
    $temp = $_POST['content'];
    $content = str_replace(["\r", "\n"], " ", $temp);
    $date_time = date('Y-m-d H:i:s');
    if(strlen($error)==0){
		$stmt = $db->prepare('INSERT INTO comments(postID, userID, contents, date_time) VALUES (?, ?, ?, ?)');
		$stmt->execute([$i, $userID[0], $content, $date_time]);
    }
    header('location: index.php');
    /*
    $fp=fopen('posts.csv.php','a+');
    fputs($fp,$_SESSION['email'].';'.date('m/d/Y').';'.$_POST['title'].';'.$_POST['content'].PHP_EOL);
    fclose($fp);
    header('location: index.php');
    die();*/
}
?>

<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Karen Social Media Site</title>
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

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5JCTSSF');</script>
    <!-- End Google Tag Manager -->

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5JCTSSF" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Start Header Area -->
    <header class="header-area">
        <!-- main menu start -->
        <div class="main-menu-wrapper sticky header-transparent">
            <div class="container custom-container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                        <div class="buy-btn text-right">
                            <a href="../signOut.php" class="btn btn-all" >Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main menu end -->
    </header>
    <!-- end Header Area -->
    <main>
        <!-- section start -->
        <section class="main-menu-wrapper section-padding pb-10">
                <div class="container custom-container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <div class="hero-slider-content">
                                <h4 class="slide-subtitle pb-3">Blogging and Social Media Site</h4>
                                <h2 class="slide-title">Karen Social</h2>
                            </div>
						</div>
                    </div>
                </div>
        </section>
        <!-- section end -->



        <style>
            form{
                text-align:center;
            }
            
        </style>

        <?php
            $stmt = $db->prepare('SELECT title FROM posts WHERE postID = ?');
            $stmt->execute([$i]);
            $post = $stmt->fetch();
            $postTitle = $post[0];
        ?>
    
        <form method="POST">
            
            <label><h3>Commenting on "<?=$postTitle?>"</h3></label><br />
		    <textarea name="content" rows="9" cols="50" placeholder="Enter comment here..." required="required"></textarea>
            <br /><br />
            <button type="submit" class="btn btn-all">Comment</button>
        </form> 

    </body>
</html>
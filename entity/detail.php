<?php 
session_start();
$i = $_GET['post_id'];

$posts = [];
$fp=fopen('posts.csv.php','r');
while(!feof($fp)){
    $line=fgets(($fp));
    $line=explode(';', trim($line));
    array_push($posts, $line);
}
array_splice($posts,0,1);
array_splice($posts, count($posts)-1, 1);


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
                                <h4 class="slide-subtitle pb-3"><?='Authored by '.$posts[$i][0].' on '.$posts[$i][1]?></h4>
                                <h2 class="slide-title"><?=$posts[$i][2]?></h2>
								
								<p><?=$posts[$i][3]?></p>
								<?php if(isset($_SESSION['email']) && $_SESSION['email'] == $posts[$i][0]) {?>
									<a href=<?php echo "edit.php?post_id=".$i?> class="btn btn-all">edit post</a>
									<a href=<?php echo "delete.php?post_id=".$i?> class="btn btn-all">delete post</a>
								<?php } ?>
                                <a href="index.php" class="btn btn-all">Return to Feed</a>
                            </div>
						</div>
                    </div>
                </div>
        </section>
	</main>
</body>
</html>
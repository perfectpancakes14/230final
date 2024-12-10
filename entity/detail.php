<?php 
require_once("../db.php");
session_start();
$i = $_GET['post_id'];

$hasName = false;
$stmt = $db->prepare('SELECT users.firstName, users.lastName FROM users INNER JOIN posts ON users.userID = posts.userID WHERE postID = ?');
$stmt->execute([$i]);
$name = $stmt->fetch();
if($name[0] == null AND $name[1] == null)
{
    $stmt = $db->prepare('SELECT users.email, posts.title, posts.contents, posts.date_time FROM users INNER JOIN posts ON users.userID = posts.userID WHERE postID = ?');
    $stmt->execute([$i]);
    $post1 = $stmt->fetch();
    $email = $post1[0];
}
else{
    $stmt = $db->prepare('SELECT users.email, users.firstName, users.lastName, posts.title, posts.contents, posts.date_time FROM users INNER JOIN posts ON users.userID = posts.userID WHERE postID = ?');
    $stmt->execute([$i]);
    $post2 = $stmt->fetch();
    $email = $post2[0];
    $hasName = true;
}
$stmt = $db->prepare('SELECT isAdmin FROM users WHERE email = ?');
$stmt->execute([$_SESSION['email'][0]]);
$temp = $stmt->fetch();
$admin = $temp[0];


/*$posts = [];
$fp=fopen('posts.csv.php','r');
while(!feof($fp)){
    $line=fgets(($fp));
    $line=explode(';', trim($line));
    array_push($posts, $line);
}
array_splice($posts,0,1);
array_splice($posts, count($posts)-1, 1);*/


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

        <?php if($hasName == true){?>
            <section class="main-menu-wrapper section-padding pb-10">
                <div class="container custom-container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <div class="hero-slider-content">
                                <h4 class="slide-subtitle pb-3"><?='Authored by '.$post2[1].' '.$post2[2].' on '.$post2[5]?></h4>
                                <h2 class="slide-title"><?=$post2[3]?></h2>
								
								<p><?=$post2[4]?></p>
								<?php if($admin == 1 || isset($_SESSION['email']) && $_SESSION['email'][0] == $email) {?>
									<a href=<?php echo "edit.php?post_id=".$i?> class="btn btn-all">edit post</a>
									<a href=<?php echo "delete.php?post_id=".$i?> class="btn btn-all">delete post</a>
								<?php } ?>
                                <a href="index.php" class="btn btn-all">Return to Feed</a>
                                <?php
                                $stmt = $db->prepare('SELECT COUNT(*) FROM users_r_posts WHERE postID = ?');
                                $stmt->execute([$i]);
                                $postLikeCount = $stmt->fetch();
                                ?>
                                <a href="postLike.php?post_id=<?=$i?>" class="btn btn-all">Like<?php echo " (".$postLikeCount[0].")"?></a>
                            </div>
						</div>
                    </div>
                </div>
        </section>
        <?php }
        else{ ?>
            <section class="main-menu-wrapper section-padding pb-10">
                <div class="container custom-container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <div class="hero-slider-content">
                                <h4 class="slide-subtitle pb-3"><?='Authored by '.$post1[0].' on '.$post1[3]?></h4>
                                <h2 class="slide-title"><?=$post1[1]?></h2>
								
								<p><?=$post1[2]?></p>
								<?php if(isset($_SESSION['email']) && $_SESSION['email'] == $email) {?>
									<a href=<?php echo "edit.php?post_id=".$i?> class="btn btn-all">edit post</a>
									<a href=<?php echo "delete.php?post_id=".$i?> class="btn btn-all">delete post</a>
								<?php } ?>
                                <a href="index.php" class="btn btn-all">Return to Feed</a>
                            </div>
						</div>
                    </div>
                </div>
        </section>
        <?php }?>

        <section class="main-menu-wrapper section-padding pb-10">
                <div class="container custom-container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <div class="hero-slider-content">
                                <h2>Comments</h2><br />
                            <table border=1>
                                <?php
                                    $stmt = $db->prepare("SELECT COUNT(*) FROM comments WHERE postID = ?");
                                    $stmt->execute([$i]);
                                    $count = $stmt->fetch();
                                    $stmt = $db->prepare("SELECT users.email, comments.contents, comments.commentID FROM users INNER JOIN comments ON users.userID = comments.userID WHERE postID = ?");
                                    $stmt->execute([$i]);
                                    $comment = $stmt->fetchAll();
                                    for ($j = 0; $j<$count[0];$j++){
                                ?>
                                    <tr>
                                        <td><h4><?php echo $comment[$j][0]?></h4></td>
                                        <td><h4><?php echo $comment[$j][1] ?></h4></td>
                                        <?php
                                        
                                        if($admin == 1 || isset($_SESSION['email']) && $_SESSION['email'][0] == $comment[$j][0]) {?>
                                            <td><a href=<?php echo "editComment.php?comment_id=".$comment[$j][2]?> class="btn btn-all">Edit comment</a></td>
                                            <td><a href=<?php echo "deleteComment.php?comment_id=".$comment[$j][2]?> class="btn btn-all">Delete comment</a></td>
                                        <?php } 
                                        
                                        $stmt = $db->prepare('SELECT COUNT(*) FROM users_r_comments WHERE commentID = ?');
                                        $stmt->execute([$comment[$j][2]]);
                                        $commentLikeCount = $stmt->fetch();
                                        ?>
                                        <td><a href="commentLike.php?comment_id=<?=$comment[$j][2]?>" class="btn btn-all">Like<?php echo " (".$commentLikeCount[0].")"?></a></td>
                                        
                                    </tr>

                                    <?php }?>
                                </table>
                                <a href="createComment.php?post_id=<?=$i?>" class="btn btn-all">Create Comment</a>
                            </div>
						</div>
                    </div>
                </div>
        </section>
        

	</main>
</body>
</html>
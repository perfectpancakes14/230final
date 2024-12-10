<?php 
require_once("../db.php");
session_start();
$i = $_GET['comment_id'];
$date = date("Y-m-d");

$email = $_SESSION['email'];
$stmt = $db->prepare('SELECT userID FROM users WHERE email = ?');
$stmt->execute([$email[0]]);
$userID = $stmt->fetch();

$stmt = $db->prepare('SELECT userID, commentID FROM users_r_comments WHERE users_r_comments.commentID = ? AND users_r_comments.userID = ?');
$stmt->execute([$i,$userID[0]]);
$likeInfo = $stmt->fetch();
$commentID = $likeInfo[1];

if($likeInfo == null){
    $stmt = $db->prepare('INSERT INTO users_r_comments(userID, commentID, date) VALUES (?, ?, ?)');
	$stmt->execute([$userID[0], $i, $date]);
}
$stmt = $db->prepare('SELECT postID FROM comments WHERE commentID = ?');
$stmt->execute([$commentID]);
$post = $stmt->fetch();

header('location: index.php');
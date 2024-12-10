<?php 
require_once("../db.php");
session_start();
$i = $_GET['post_id'];
$date = date("Y-m-d");

$email = $_SESSION['email'];
$stmt = $db->prepare('SELECT userID FROM users WHERE email = ?');
$stmt->execute([$email[0]]);
$userID = $stmt->fetch();

$stmt = $db->prepare('SELECT userID, postID FROM users_r_posts WHERE postID = ? AND userID = ?');
$stmt->execute([$i,$userID[0]]);
$likeInfo = $stmt->fetch();

if($likeInfo == null){
    $stmt = $db->prepare('INSERT INTO users_r_posts(userID, postID, date) VALUES (?, ?, ?)');
	$stmt->execute([$userID[0], $i, $date]);
}
header('location: detail.php?post_id='.$i);
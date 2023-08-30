<?php
require('db.php');
$comment = $_GET['comment'];
$id1 = $_GET['id'];
$username = $_GET['username'];
$result = "$username" . ":" . "$comment";
$sql = "SELECT comments FROM posts WHERE post_id='$id1'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$arr = $row['comments'];
$existing_comments = json_decode($arr, true);
print_r($existing_comments);
$new_comment = array($username => $comment);
$existing_comments[$username] = $comment;
$updated_comments_json = json_encode($existing_comments);

echo $updated_comments_json;

$query = "UPDATE posts SET comments='$updated_comments_json' WHERE post_id = '$id1'";
$con->query($query);
?>
<?php
require('db.php');
$likes = $_GET['likes'];
$nlikes = (intval($likes) + 1);
echo $nlikes;
$id1 = $_GET['post_id'];
$query = "UPDATE posts SET likes='$nlikes' where post_id = '$id1'";
$con->query($query);
?>
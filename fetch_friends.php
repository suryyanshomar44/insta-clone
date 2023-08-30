<?php

require('db.php');

$username = $_SESSION["username"];
$sql = "SELECT * from users WHERE username='$username'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$arr = $row['friends'];

$arr = json_decode($arr, true);
if ($arr) {
    $idsString = implode(',', $arr);

    $query = "SELECT * FROM users WHERE id IN ($idsString)";

    $result = $con->query($query);

    $results = $result->fetch_all(MYSQLI_ASSOC);

    $res = json_encode($results);
}

$con->close();

?>
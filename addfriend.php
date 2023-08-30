<?php
include('auth_session.php');
require('db.php');
$username = $_SESSION["username"];
$sql = "SELECT * from users WHERE username='$username'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$arr = $row['friends'];
$arr = json_decode($arr, true);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!in_array($id, $arr)) {
        array_push($arr, $id);
        $array = implode(',', $arr);
        echo $array;
        $friends = '[' . $array . ']';

        $query = "UPDATE users SET friends='$friends' WHERE username='$username'";
        $result = $con->query($query);
    }

    $con->close();
}


?>
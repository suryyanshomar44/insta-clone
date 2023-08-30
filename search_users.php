<?php

require('db.php');

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    $searchTerm = mysqli_real_escape_string($con, $searchTerm);

    $sql = "SELECT * FROM users WHERE username LIKE '%$searchTerm%'";
    $result = $con->query($sql);

    $users = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row['username'];
        }
    }

    echo json_encode($users);
}

$con->close();
?>
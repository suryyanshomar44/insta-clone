<?php

require('db.php');

if (isset($_GET['name'])) {
    $username = $_GET['name'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        die("User not found");
    }
    $con->close();
}
?>

<div class="profile" style="margin-top: 50px;">
    <h2>
        <?php echo $row['fullname']; ?>'s Profile
    </h2>
    <table>
        <tr>
            <td><img src="person.png" style="height: 50px; width: 50px; float: left; margin: 10px" /></td>
            <td>Username:
                <?php echo $row['username']; ?>
            </td>

        </tr>
        <tr>
            <td></td>
            <td>Email:
                <?php echo $row['email']; ?>
            </td>
        </tr>

    </table>


    <div style="margin-top: 40px;">
        <button class="cbutton" id="follow" onclick='followbtn(event, <?php echo $row['id'] ?>)'>Follow</button>
        <button class="cbutton">Message</button>
    </div>
</div>
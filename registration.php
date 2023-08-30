<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;800&family=Pacifico&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php
    require("db.php");

    if (isset($_REQUEST['username']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $fname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $create_datetime = date("Y-m-d H:i:s");
        $sql = "INSERT into `users` (username, password, email, create_datetime, fullname)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime', '$fname')";
        $result = $con->query($sql);
        if ($result) {
            header("location: login.php");
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
        ?>
        <form class="form" action="" method="post">
            <h1 class="login-title">INSTAGRAM</h1>
            <p class="text" style="text-align: center; margin-bottom: 30px;">Sign up to see photos and videos from your
                friends.</p>
            <input type="text" class="login-input" name="email" placeholder="Email Adress">
            <input type="text" class="login-input" name="username" placeholder="Username" required />
            <input type="text" class="login-input" name="fullname" placeholder="FullName" required />
            <input type="password" class="login-input" name="password" placeholder="Password">
            <p class="text" style="font-size: 12px; text-align: center; color:#6e8095;">By signing up, you agree to our
                Terms, Privacy
                Policy and Cookies
                Policy.</p>
            <input type="submit" name="submit" value="Sign Up" class="login-button">

        </form>
        <div class="form text" style="margin-top: 20px; text-align: center;">
            <span style="color: black">Have an account? </span>
            <span><a href="login.php">Sign in</a></span>
        </div>
        <?php
    }
    ?>
</body>

</html>
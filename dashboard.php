<?php
include("auth_session.php");

?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;800&family=Pacifico&display=swap"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
            height: 100%;
        }

        .insta {
            color: #222121;
            font-size: 22px;
            text-shadow: 1.5px 1.5px #9f9fa0;
            font-family: 'Montserrat', sans-serif;
            font-family: 'Pacifico', cursive;
            font-weight: 2000;
            margin-top: 14px;

        }

        h3 {
            color: #222121;
            font-size: 22px;
            text-shadow: 1.5px 1.5px #9f9fa0;
            font-weight: 2000;
            margin-top: 14px;
        }

        .container {
            display: grid;
            grid-template-areas:
                "header header header"
                "left body right";
            grid-template-columns: 1fr 2fr 1fr;
            grid-template-rows: auto 1fr;
            min-height: 100vh;
            width: 100%;
        }

        .left {
            grid-area: left;
            background-color: #f9f9f9;
            padding: 20px;

        }

        .body {
            grid-area: body;
            background-color: #fff;
            padding: 20px;
            display: grid;
            align-items: center;
            justify-content: center;


        }

        .cardContainer {
            overflow: scroll;
            height: 600px;
            max-height: 2000px;
            overflow-x: hidden;
        }

        .right {
            grid-area: right;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .dropdown {
            display: none;
            position: absolute;
            width: 100%;
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background-color: #fff;
            z-index: 1;
            margin-top: 40px;
        }

        .dropdown li {
            padding: 10px;
            cursor: pointer;
        }

        .dropdown li:hover {
            background-color: #f2f2f2;
        }

        .card1 {
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .username {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .post-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }

        .description {
            margin-top: 10px;
        }

        .comments {
            margin-top: 10px;
            padding: 5px;
            border-top: 1px solid #ccc;
        }

        .comment {
            margin-bottom: 5px;
        }

        .cbutton {
            background-color: #3897f0;
            color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>




<body onload="fetchposts()">
    <input type="hidden" id="username" value="<?php echo $_SESSION['username']; ?>">
    <div class="container">
        <div class="left">
            <img src="logo2.jfif" style="height: 40px; width: 40px; float: left; margin: 10px" />
            <h2 class="insta">
                INSTAGRAM
            </h2>
            <h3 style="margin-top: 70px; font-weight: 600;"> Friends </h3>
            <div class="card border border-primary" style="width: 18rem; margin-top: 10px;">
                <div id="cfriend">

                    <ul class="list-group list-group-flush">
                        <?php
                        require('fetch_friends.php');
                        if ($arr) {
                            $data = json_decode($res, true);
                            foreach ($data as $item) {
                                print_r("<li class='list-group-item font-weight-bold' style='color: #352340;'>" . $item['username'] . "</li>");
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="input-group">
                <input type="search" id="searchInput" class="form-control rounded" placeholder="Search"
                    aria-label="Search" aria-describedby="search-addon" />
                <button type="button" id="searchButton" class="btn btn-outline-primary">Search</button>
                <div class="dropdown">
                    <ul id="searchResults"></ul>
                </div>
            </div>
            <div class="cardContainer" id="bodyContainer">
            </div>
        </div>
        <div class="right">
            <img src="person.png" onclick="userProfilehandler()"
                style="height: 40px; width: 40px; float: left; margin: 10px" />
            <h3>
                <?php echo "HI! " . $_SESSION['username']; ?>
            </h3>
            <h3 style="margin-top: 50px"> Message</h3>
            <div class="card border border-primary" style="width: 18rem; margin-top: 10px;">

                <ul class="list-group list-group-flush">

                    <?php
                    if ($arr) {
                        require('fetch_friends.php');
                        $data = json_decode($res, true);
                        foreach ($data as $item) {
                            print_r("<li class='list-group-item font-weight-bold' style='color: #352340;'>" . $item['username'] . "<span style='color: #5975ff; float: right;'>message</span> </li>");
                        }
                    }
                    ?>

                </ul>

            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>


</body>

</html>
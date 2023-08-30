<?php
require('db.php');
include("auth_session.php");
$sql = "SELECT * FROM posts";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    $username = $_SESSION["username"];

    while ($row = $result->fetch_assoc()) {
        $commentsArray = json_decode($row['comments'], true);
        ?>

        <div class="card1">
            <p class="username">
                <?php echo $row['title']; ?>
            </p>

            <img class="post-image" src="zoro.webp" alt="Post Image" />

            <div class="description">
                <p>
                    <?php echo $row['description']; ?>
                </p>
            </div>
            <div>
                <span id="<?php echo $row['post_id'] . "likes"; ?>">
                    <?php echo $row['likes'] . ' '; ?>likes
                </span>
            </div>

            <div class="comments<?php echo $row['post_id']; ?>">
                <?php
                foreach ($commentsArray as $user => $comment) {
                    echo "<div class='comment'>" . $user . " :   " . $comment . "</div>";
                }
                ?>
            </div>

            <div>
                <button class="cbutton"
                    onclick="likehandler(<?php echo $row['post_id']; ?>, <?php echo $row['likes']; ?>)">Like</button>

                <button class="cbutton" onclick="commentCollapseHandler(<?php echo $row['post_id']; ?>)">Add
                    Comment</button>
                <div id="commentSection<?php echo $row['post_id']; ?>" style="display: none; margin-top: 10px;">
                    <input type="text" style="width: 83%" id="commentInput<?php echo $row['post_id']; ?>"
                        placeholder="Enter your comment here" />



                    <button onclick="commentHandler(<?php echo $row['post_id']; ?>)">Done</button>
                </div>
            </div>
        </div>

        <?php
    }
}

?>


<?php $con->close(); ?>
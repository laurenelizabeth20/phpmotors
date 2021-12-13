<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Review | PHP Motors</title>
        <link rel="stylesheet" title="CSS" media="screen" href="../css/vehicles.css">
    </head>
    <body>
        <div class="content">
            <div class='header'>
                <img src="../images/site/logo.png" alt="PHP Motors Logo">
                <?php require_once 'header.php';?>
            </div>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main>
                <h1>Delete Review</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/phpmotors/reviews/">
                    <label for="user">User</label>
                    <input type="text" readonly name="user" id="user" value="<?php
                    echo substr($_SESSION['clientData']['clientFirstname'], 0, 1), $_SESSION['clientData']['clientLastname'];?>">

                    <label for="reviewDate">Publish Date: </label>
                    <input type="text" readonly name="reviewDate" id="reviewDate" <?php
                    if(isset($reviewInfo['reviewDate'])) {echo "value='$reviewInfo[reviewDate]'"; }?>>

                    <label for="reviewText">Review: </label>
                    <input type="text" name="reviewText" readonly id="reviewText" <?php
                    if(isset($reviewInfo['reviewText'])) {echo "value='$reviewInfo[reviewText]'"; }
                    ?>>
                    <input type="hidden" name="action" value="deleteReview">
                    <input type="hidden" name="reviewId" value="<?php if(isset($reviewInfo['reviewId'])){
                    echo $reviewInfo['reviewId'];} ?>">
                    <button name="action" value="deleteReview">Delete</button>
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
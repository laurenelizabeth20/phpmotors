<?php
    if (!$_SESSION['loggedin']) {
        header("Location: http://lvh.me/phpmotors/");
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Account Update | PHP Motors</title>
        <link rel="stylesheet" title="CSS" media="screen" href="../css/accounts.css">
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
                <h1>Review Update</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/phpmotors/reviews/index.php" method="post">
                    <label for="User">User: </label><br>
                    <input type="text" name="User" id="User" value="<?php echo substr($_SESSION['clientData']['clientFirstname'], 0, 1), $_SESSION['clientData']['clientLastname']; ?>" readonly><br>
                    <label for="reviewDate">Date Published: </label><br>
                    <input type="text" name="reviewDate" id="reviewDate" <?php if(isset($reviewInfo['reviewDate'])){echo "value='$reviewInfo[reviewDate]'";} elseif(isset($reviewDate)) {echo "value='$reviewDate'"; }?> readonly><br>
                    <label for="reviewText">Review: </label><br>
                    <input type="text" name="reviewText" id="reviewText" required <?php if(isset($reviewInfo['reviewText'])){echo "value='$reviewInfo[reviewText]'";}?>><br>
                    <input type="hidden" name="submit" value="updateReview">
                    <button name="action" value="updateReview">Update</button>
                    <input type="hidden" name="reviewId" value="
                        <?php echo $reviewId;?>
                    ">
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
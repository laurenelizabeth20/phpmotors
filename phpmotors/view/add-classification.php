<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Classification | PHP Motors</title>
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
                <h1>Add Car Classification</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <label for="classificationName">Classification*:</label><br>
                    <input name="classificationName" id="classificationName" type="text" placeholder='Classification' maxlength="30" required><br>
                    <span>Classification names are limited to 30 characters</span><br>
                    <button name="action" value="submitClassification">Add Classification</button>
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
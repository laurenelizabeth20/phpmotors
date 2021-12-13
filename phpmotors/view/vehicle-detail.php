<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $vehicleInfo['invMake'], " ", $vehicleInfo['invModel']; ?> | PHP Motors, Inc.</title>
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
            <h1><?php echo $vehicleInfo['invMake'], " ", $vehicleInfo['invModel']; ?></h1>
            <p>Reviews can be seen at the bottom of the page.</p>
            <?php if(isset($message)){
            echo $message; }
            ?>
            <div class="vehicleInfo">
            <?php if(isset($vehicleDetails)){
            echo $vehicleDetails;
            } ?>
            

            <?php
            if(isset($additionalImages)){
                echo $images;
                } ?>

            </div>
            <h2>Customer Reviews</h2>
            <?php 
                echo $reviewForm;
                echo $reviewList;
            ?>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
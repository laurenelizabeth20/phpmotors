<?php
    if ($_SESSION['loggedin'] && $_SESSION['clientData']['clientLevel'] > 1) {

    }
    else{
        header("Location: http://lvh.me/phpmotors/");
        exit;
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
       }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Vehicle Management | PHP Motors</title>
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
                <h1>Vehicle Management</h1>
                <div class="vehicleLinks">
                    <?php echo $addClassification; ?>
                    <?php echo $addVehicle; ?>
                </div>
                <?php if (isset($message)) { 
                    echo $message; 
                } ?>
                <?php
                if (isset($classificationList)) { 
                    echo '<h2>Vehicles By Classification</h2>'; 
                    echo '<p>Choose a classification to see those vehicles</p>'; 
                    echo $classificationList; 
                }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
    <script src="../js/inventory.js"></script>
</html>
<?php unset($_SESSION['message']); ?>
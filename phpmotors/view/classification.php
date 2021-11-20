<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $classificationName; ?> Vehicles | PHP Motors, Inc.</title>
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
            <h1><?php echo $classificationName; ?> Vehicles</h1>
            <?php if(isset($message)){
            echo $message; }
            ?>
            <?php if(isset($vehicleDisplay)){
            echo $vehicleDisplay;
            } ?>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
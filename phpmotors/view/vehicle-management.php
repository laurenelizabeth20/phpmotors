<!DOCTYPE html>
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
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
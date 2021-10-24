<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Vehicle | PHP Motors</title>
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
                <h1>Add Vehicle</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <label for="invMake">Make: </label><br>
                    <input type="text" name="invMake" id="invMake"><br>
                    <label for="invModel">Model: </label><br>
                    <input type="text" name="invModel" id="invModel"><br>
                    <label for="invDescription">Description: </label><br>
                    <input type="text" name="invDescription" id="invDescription"><br>
                    <label for="invImage">Image: </label><br>
                    <input type="image" name="invImage" id="invImage" alt="image"><br>
                    <label for="invThumbnail">Thumbnail: </label><br>
                    <input type="image" name="invThumbnail" id="invThumbnail" alt="image"><br>
                    <label for="invPrice">Price: </label><br>
                    <input type='number' name='invPrice' id='invPrice'><br>
                    <label for="invStock">Stock: </label><br>
                    <input type='number' name='invStock' id='invStock'><br>
                    <label for="invColor">Color: </label><br>
                    <input type='text' name='invColor' id='invColor'><br>
                    <label>Choose a Car classification: </label><br>
                    <?php echo $classificationList; ?><br>
                    <button name="action" value="submitVehicle">Submit</button>
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
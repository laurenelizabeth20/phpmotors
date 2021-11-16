<?php
$classificationList = '<select id=classification name="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
            $classificationList .= ' selected ';
        }
    }elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
            $classifList .= ' selected ';
        }
    }
    
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

if ($_SESSION['loggedin'] && $_SESSION['clientData']['clientLevel'] > 1) {

}
else{
    header("Location: http://lvh.me/phpmotors/");
    exit;
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	    elseif(isset($invMake) && isset($invModel)) { 
		    echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
                <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	            elseif(isset($invMake) && isset($invModel)) { 
		            echo "Modify $invMake $invModel"; }?></h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/phpmotors/vehicles/index.php" method="post">
                    <label for="invMake">Make: </label><br>
                    <input type="text" name="invMake" id="invMake" required placeholder="Make" <?php if(isset($invMake)){echo "value='$invMake'";}  elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>
                    <label for="invModel">Model: </label><br>
                    <input type="text" name="invModel" id="invModel" required placeholder="Model" <?php if(isset($invModel)){echo "value='$invModel'";}  elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>
                    <label for="invDescription">Description: </label><br>
                    <input type="text" name="invDescription" id="invDescription" required placeholder="Description" <?php if(isset($invDescription)){echo "value='$invDescription'";}  elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?>><br>
                    <label for="invImage">Image: </label><br>
                    <input type="text" name="invImage" id="invImage" alt="image" <?php if(isset($invImage)){echo "value='$invImage'";}  elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>><br>
                    <label for="invThumbnail">Thumbnail: </label><br>
                    <input type="text" name="invThumbnail" id="invThumbnail" alt="image" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>><br>
                    <label for="invPrice">Price: </label><br>
                    <input type='number' name='invPrice' id='invPrice' required placeholder="Price" <?php if(isset($invPrice)){echo "value='$invPrice'";}  elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br>
                    <label for="invStock">Stock: </label><br>
                    <input type='number' name='invStock' id='invStock' required placeholder="Stock" <?php if(isset($invStock)){echo "value='$invStock'";}  elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br>
                    <label for="invColor">Color: </label><br>
                    <input type='text' name='invColor' id='invColor' required placeholder="Color" <?php if(isset($invColor)){echo "value='$invColor'";}  elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br>
                    <label>Choose a Car classification: </label><br>
                    <?php echo $classificationList; ?><br>
                    <input type="hidden" name="submit" value="updateVehicle">
                    <button name="action" value="updateVehicle">Submit</button>
                    <input type="hidden" name="invId" value="
                        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                        elseif(isset($invId)){ echo $invId; } ?>
                    ">
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
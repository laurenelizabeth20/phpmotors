<?php
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
	        echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	    elseif(isset($invMake) && isset($invModel)) { 
		    echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
	                echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	            elseif(isset($invMake) && isset($invModel)) { 
		            echo "Delete $invMake $invModel"; }?></h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form method="post" action="/phpmotors/vehicles/">
                    <fieldset>
                        <label for="invMake">Vehicle Make</label>
                        <input type="text" readonly name="invMake" id="invMake" <?php
                    if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

                        <label for="invModel">Vehicle Model</label>
                        <input type="text" readonly name="invModel" id="invModel" <?php
                    if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

                        <label for="invDescription">Vehicle Description</label>
                        <textarea name="invDescription" readonly id="invDescription"><?php
                    if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
                    ?></textarea>

                    <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

                        <input type="hidden" name="action" value="deleteVehicle">
                        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
                    echo $invInfo['invId'];} ?>">

                    </fieldset>
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
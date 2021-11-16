<?php
    if (!$_SESSION['loggedin']) {
        header("Location: http://lvh.me/phpmotors/");
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin | PHP Motors</title>
        <link rel="stylesheet" title="CSS" media="screen" href="../css/accounts.css">
    </head>
    <body>
        <div class="content">
            <div class='header'>
                <img src="../images/site/logo.png" alt="PHP Motors Logo">
                <?php require_once '../view/header.php';?>
            </div>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }?>
            <main class='adminInfo'>
                <?php
                echo "<h2>", $_SESSION['clientData']['clientFirstname'], " ", $_SESSION['clientData']['clientLastname'], ", you are logged in</h2>";
                echo "<ul>
                <li> First name: ",  $_SESSION['clientData']['clientFirstname'], "</li>
                <li> Last name: ", $_SESSION['clientData']['clientLastname'], "</li>
                <li> Email address: ", $_SESSION['clientData']['clientEmail'], "</li>
                </ul>
                <p><a href='/phpmotors/accounts/index.php?action=".urlencode('account-update')."' title='Account Update Page'>Account Update Page</a></p>";
                if($_SESSION['clientData']['clientLevel'] > 1){
                    echo "<h3>Vehicles Management</h3>
                    <p>Use this link to administer inventory: <a href='/phpmotors/vehicles/index.php?action=".urlencode('vehicles')."' title='Vehicle Management Page'>Vehicle Management Page</a></p>";
                }?>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
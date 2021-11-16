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
                <h1>Account Update</h1>
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
                <form action="/phpmotors/accounts/index.php" method="post">
                    <label for="clientFirstname">First Name: </label><br>
                    <input type="text" name="clientFirstname" id="clientFirstname" required placeholder="First Name" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo "value=", $_SESSION['clientData']['clientFirstname']; }?>><br>
                    <label for="clientLastname">Last Name: </label><br>
                    <input type="text" name="clientLastname" id="clientLastname" required placeholder="Last Name" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value=", $_SESSION['clientData']['clientLastname']; }?>><br>
                    <label for="clientEmail">Email: </label><br>
                    <input type="text" name="clientEmail" id="clientEmail" required placeholder="Email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  elseif(isset($_SESSION['clientData']['clientEmail'])) {echo "value=", $_SESSION['clientData']['clientEmail']; }?>><br>
                    <input type="hidden" name="submit" value="updateClient">
                    <button name="action" value="updateClient">Update</button>
                    <input type="hidden" name="clientId" value="
                        <?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>
                    ">
                </form>
                <h1>Change Password</h1>
                <?php
                if (isset($passMessage)) {
                    echo $passMessage;
                }
                ?>
                <form action="/phpmotors/accounts/index.php" method="post">
                    <label for="clientPassword">New Password*:</label><br>
                    <input type="password" name="clientPassword" id="clientPassword" required placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                    <p>This new password will replace your old password.</p>
                    <button name="action" value="changePassword">Change Password</button>
                    <!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="changePassword">
                    <input type="hidden" name="clientId" value="
                        <?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
                        elseif(isset($clientId)){ echo $clientId; } ?>
                    ">
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
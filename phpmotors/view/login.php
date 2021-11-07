<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login | PHP Motors</title>
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
                <h1>PHP Motors Login</h1>
                <?php if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    }
                ?>
                <form action="/phpmotors/accounts/" method="post">
                    <label for="clientEmail">Email Address*:</label><br>
                    <input name="clientEmail" id="clientEmail" type="email" placeholder='Email' <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required><br>
                    <label for="clientPassword">Password*:</label><br>
                    <input type="password" name="clientPassword" id="clientPassword" required placeholder="Password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                    <button>Login</button>
                    <input type="hidden" name="action" value="Login">
                    <p>No account? <?php echo $signup; ?></p>
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
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
                <h1>Login</h1>
                <form>
                    <label for="clientEmail">Email Address*:</label><br>
                    <input name="clientEmail" id="clientEmail" type="text" placeholder='Email' required><br>
                    <label for="clientPassword">Password*:</label><br>
                    <input name="clientPassword" id="clientPassword" type="text" placeholder='Password' required><br>
                    <button>Login</button>
                    <p>No account? <?php echo $signup; ?></p>
                </form>
            </main>
            <?php require_once '../footer.php';?>
        </div>
    </body>
</html>
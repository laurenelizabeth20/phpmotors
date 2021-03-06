<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home | PHP Motors</title>
        <link rel="stylesheet" title="CSS" media="screen" href="css/home.css">
    </head>
    <body>
        <div class="content">
            <div class='header'>
                <img src="images/site/logo.png" alt="PHP Motors Logo">
                <?php require_once 'view/header.php';?>
            </div>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main>
                <h1>Welcome to PHP Motors!</h1>
                <div class="blurb">
                    <h3>DMC Delorean</h3>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                    <div id="own">
                        <img src="images/site/own_today.png" alt="Own Today">
                    </div>
                </div>
                <div class="upgrade-review">
                    <div class="reviews">
                        <h2>DMC Delorean Reviews</h2>
                        <ul>
                            <li>"So fast its almost like traveling in time." (4/5)</li>
                            <li>"Coolest ride on the road." (4/5)</li>
                            <li>"I'm feeling like Marty McFly!" (5/5)</li>
                            <li>"The most futuristic ride of our day." (4.5/5)</li>
                            <li>"80's livin and I love it!" (5/5)</li>
                        </ul>
                    </div>
                    <div class="upgrades">
                        <h2>Delorean Upgrades</h2>
                        <div class="flux">
                            <img src="images/upgrades/flux-cap.png" alt="Flux Capacitor"><br>
                            <a href="#">Flux Capacitor</a>
                        </div>
                        <div class="flame">
                            <img src="images/upgrades/flame.jpg" alt="Flame Decals"><br>
                            <a href="#">Flame Decals</a>
                        </div>
                        <div class="stickers">
                            <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers"><br>
                            <a href="#">Bumper Stickers</a>
                        </div>
                        <div class="hub">
                            <img src="images/upgrades/hub-cap.jpg" alt="Hub Cap"><br>
                            <a href="#">Hub Cap</a>
                        </div>
                    </div>
                </div>
            </main>
            <?php require_once 'footer.php';?>
        </div>
    </body>
</html>
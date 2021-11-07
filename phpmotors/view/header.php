<header>
    <?php if($_SESSION['loggedin']){
        echo "<a href='/phpmotors/accounts/index.php?action=".urlencode('admin')."' title='Admin Page'>Welcome ", $_SESSION['clientData']['clientFirstname'], ".  $logout</a>";
    } else{
        echo $login;}?>
</header>
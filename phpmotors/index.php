<?php

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

require_once 'model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$logout = "<a href='/phpmotors/index.php?action=".urlencode('logout')."' title='Logout Here'>Logout</a>";
$signup = "<a href='/phpmotors/accounts/index.php?action=".urlencode('signup')."' title='Sign Up'>Sign-up</a>";

$clientData = getClient($clientEmail);

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action){
    case 'template':
        include 'view/template.php';
        break;

    case 'logout':
        $_SESSION['loggedin'] = FALSE;
        session_unset();
        session_destroy();
        include 'view/home.php';
        break;
    
    default:
        include 'view/home.php';
        break;
}


?>
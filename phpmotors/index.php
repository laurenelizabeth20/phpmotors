<?php

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$signup = "<a href='/phpmotors/accounts/index.php?action=".urlencode('signup')."' title='Sign Up'>Sign-up</a>";

switch ($action){
    case 'template':
        include 'view/template.php';
        break;
    
    default:
        include 'view/home.php';
        break;
}


?>
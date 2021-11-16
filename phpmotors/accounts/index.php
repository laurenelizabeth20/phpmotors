<?php
//Accounts Controller

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Create or access a Session
session_start();

// Get the functions library
require_once '../library/functions.php';
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$logout = "<a href='/phpmotors/index.php?action=".urlencode('logout')."' title='Logout Here'>Logout</a>";
$signup = "<a href='/phpmotors/accounts/index.php?action=".urlencode('signup')."' title='Sign Up'>Sign-up</a>";

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'login':
        include '../view/login.php';
        break;

    case 'admin':
        include '../view/admin.php';
        break;

    case 'signup':
        include '../view/registration.php';
        break;
    
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail){
         $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
         include '../view/login.php';
         exit;
        }
        
        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;

        case 'Login':
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientEmail = checkEmail($clientEmail);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $passwordCheck = checkPassword($clientPassword);

            // Run basic checks, return if errors
            if (empty($clientEmail) || empty($passwordCheck)) {
                $message = '<p class="notice">Please provide a valid email address and password.</p>';
                include '../view/login.php';
                exit;
            }
            
            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if(!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;
            break;

        case 'account-update':
            include '../view/client-update.php';
            break;

        case 'updateClient':
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_STRING);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientEmail = checkEmail($clientEmail);
            $existingEmail = checkExistingEmail($clientEmail);

            if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
                if($existingEmail){
                    $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                    include '../view/login.php';
                    exit;
                   }
            }
                
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                $message = '<p>Please fill all fields!</p>';
                include '../view/client-update.php';
                exit;
            }
            
            $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

            $clientData = getClientById($_SESSION['clientData']['clientId']);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;

            if ($updateResult ===1) {
                $message = "<p class='notice'>Congratulations, your account was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/accounts/');
                exit;
            } else {
                $message = "<p class='notice'>Error. your account was not updated.</p>";
                include '../view/client-update.php';
                exit;
            }

            break;

            case 'changePassword':
                $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
                $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
                $passwordCheck = checkPassword($clientPassword);
                    
                if (!$passwordCheck) {
                    $passMessage = '<p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character!</p>';
                    include '../view/client-update.php';
                    exit;
                }
                if (empty($passwordCheck)) {
                    $passMessage = '<p>Please fill all fields!</p>';
                    include '../view/client-update.php';
                    exit;
                }

                $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
                
                $updateResult = updatePassword($hashedPassword, $clientId);
                if ($updateResult ===1) {
                    $message = "<p class='notice'>Congratulations, your password was successfully updated.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /phpmotors/accounts/');
                    exit;
                } else {
                    $message = "<p class='notice'>Error. your password was not updated.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /phpmotors/accounts/');
                    exit;
                }
                
                break;

        default:
            include '../view/admin.php';
            break;
}


?>
<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$addClassification = "<a href='/phpmotors/vehicles/index.php?action=".urlencode('addClassification')."' title='Add Car Classification'>Add Car Classification</a>";
$addVehicle = "<a href='/phpmotors/vehicles/index.php?action=".urlencode('addVehicle')."' title='Add Vehicle'>Add Vehicle</a>";

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);


//$classificationList = '<select id=classification name="classificationId" required placeholder="Classification">';
//foreach ($classifications as $classification) {
//    $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
//}
//$classificationList .= '</select>';

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'addClassification':
        include '../view/add-classification.php';
        break;

    case 'addVehicle':
        include '../view/add-vehicle.php';
        break;
    
    case 'submitClassification':
        // Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

        // Check the classification name is not longer than 30 characters
        if(strlen($classificationName) > 30){
            $message = '<p>Please provide a classification name that is no longer than 30 characters.</p>';
            include '../view/add-classification.php';
            exit;
        }

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p>Please provide information for empty form field.</p>';
            include '../view/add-classification.php';
            exit; 
        }

        // Send the data to the model
        $addClassificationOutcome = addClassification($classificationName);

        // Check and report the result
        if($addClassificationOutcome === 1){
            include '../view/vehicle-management.php';
            exit;
        } else {
            $message = "<p>Sorry adding the classification failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;

        case 'submitVehicle':
            // Filter and store the data
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
            $invImage = "/images/no-image.png";
            $invThumbnail = "/images/no-image.png";
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));
    
            // Check for missing data
            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/add-vehicle.php';
                exit; 
            }
    
            // Send the data to the model
            $addVehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
    
            // Check and report the result
            if($addVehicleOutcome === 1){
                $message = "<p>Thanks for registering $invMake $invModel.</p>";
                include '../view/add-vehicle.php';
                exit;
            } else {
                $message = "<p>Sorry adding the vehicle failed. Please try again.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            break;

    default:
        include '../view/vehicle-management.php';
        break;
}
?>
<?php

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();
$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$addClassification = "<a href='/phpmotors/vehicles/index.php?action=".urlencode('addClassification')."' title='Add Car Classification'>Add Car Classification</a>";
$addVehicle = "<a href='/phpmotors/vehicles/index.php?action=".urlencode('addVehicle')."' title='Add Vehicle'>Add Vehicle</a>";

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';


$classificationList = '<select id=classification name="classificationId">';
foreach ($classifications as $classification) {
    $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
}
$classificationList .= '</select>';

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
        $classificationName = filter_input(INPUT_POST, 'classificationName');

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
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = "/images/no-image.png";
            $invThumbnail = "/images/no-image.png";
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');
            $classificationId = filter_input(INPUT_POST, 'classificationId');
    
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
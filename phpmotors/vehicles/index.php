<?php

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the uploads model
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';
require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();
$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$logout = "<a href='/phpmotors/index.php?action=".urlencode('logout')."' title='Logout Here'>Logout</a>";
$addClassification = "<a href='/phpmotors/vehicles/index.php?action=".urlencode('addClassification')."' title='Add Car Classification'>Add Car Classification</a>";
$addVehicle = "<a href='/phpmotors/vehicles/index.php?action=".urlencode('addVehicle')."' title='Add Vehicle'>Add Vehicle</a>";

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);


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
            header("Location: http://lvh.me/phpmotors/vehicles/index.php?action=addClassification");
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
            $invImage = "/images/vehicles/no-image.png";
            $invThumbnail = "/images/vehicles/no-image.png";
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
    case 'vehicles':
        
        include '../view/vehicle-management.php';
        break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
         $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;

    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
        if (empty($classificationId) || empty($invMake) || empty($invModel) 
        || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p>Please complete all information for the item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit;
        }
        
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updateResult ===1) {
            $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
		    $message = 'Sorry, no vehicle information could be found.';
	    }
	    include '../view/vehicle-delete.php';
	    exit;
        break;

    case 'deleteVehicle':
		$invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }	
        break;

    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        include '../view/classification.php';
        break;

    case 'vehicleInfo':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $vehicleInfo = getVehicleById($invId);
        $additionalImages = getAdditionalImages($invId);
        $reviews = getInventoryReviews($invId);
        $reviewList = buildReviews($reviews);
        $reviewForm = buildReviewForm($invId);

        if(!isset($vehicleInfo)){
            $message = "<p class='notice'>Sorry, no $vehicleInfo[invMake] $vehicleInfo[invModel] could be found.</p>";
        } else {
            $vehicleDetails = buildVehicleInfo($vehicleInfo);
            if(isset($additionalImages)){
                $images = buildAdditionalImages($additionalImages, $vehicleInfo);
            }
            if(!isset($reviews)) {
                $message = "<p>There are no reviews for this vehicle yet.</p>";
            }
            else {
                $reviewList = buildReviews($reviews);
            }
        }
        
        
        include '../view/vehicle-detail.php';
        break;

    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-management.php';
        break;
}
?>
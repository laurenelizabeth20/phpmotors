<?php #Reviews controller

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);
$login = "<a href='/phpmotors/accounts/index.php?action=".urlencode('login')."' title='Login Here'>My Account</a>";
$logout = "<a href='/phpmotors/index.php?action=".urlencode('logout')."' title='Logout Here'>Logout</a>";


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'addReview':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if(empty($reviewText)){
            $_SESSION['message'] = '<p>Please provide review.</p>';
            header('location: http://lvh.me/phpmotors/vehicles/?action=vehicleInfo&invId=' . $invId);
            exit; 
        }

        $addReview = addReviews($reviewText, $invId, $clientId);

        // Check and report the result
        if($addReview === 1){
            $_SESSION['message'] = "<p>Thanks for reviewing.</p>";
            header('location: http://lvh.me/phpmotors/vehicles/?action=vehicleInfo&invId=' . $invId);
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry adding the review failed. Please try again.</p>";
            header('location: http://lvh.me/phpmotors/vehicles/?action=vehicleInfo&invId=' . $invId);
            exit;
        }
        break;

    case 'editReview':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = getSpecificReview($reviewId);
        include '../view/edit-review.php';
        break;

    case 'updateReview':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = getSpecificReview($reviewId);

        // Check for missing data
        if(empty($reviewText)){
            $message = '<p>Please provide review.</p>';
            include '../view/add-review.php';
            exit; 
        }

        $updateReview = updateReview($reviewInfo['reviewId'], $reviewText, $reviewInfo['reviewDate'], $reviewInfo['invId'], $reviewInfo['clientId']);

        // Check and report the result
        if($updateReview === 1){
            $message = "<p>Thanks for reviewing.</p>";
            header('location: http://lvh.me/phpmotors/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "<p>Sorry updating the review $reviewId failed. Please try again.</p>";
            header('location: http://lvh.me/phpmotors/accounts/index.php?action=admin');
            exit;
        }
        break;

    case 'deleteConfirmation':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = getSpecificReview($reviewId);
        include '../view/delete-review.php';
        break;

    case 'deleteReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($reviewId);
        if ($deleteResult === 1) {
            $message = "<p class='notice'>Congratulations your review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: http://lvh.me/phpmotors/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "<p class='notice'>Error: Review was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: http://lvh.me/phpmotors/accounts/index.php?action=admin');
            exit;
        }	
        break;
    
    default:
        if ($_SESSION['loggedin']) {
            include '../view/admin.php';
            exit;
        }
        header('location: http://lvh.me/phpmotors/');
        break;
}
?>
<?php #Reviews model

#Insert a review
function addReviews($reviewText, $invId, $clientId) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

#Get reviews for specific inventory item
function getInventoryReviews($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, DATE_FORMAT(reviewDate, "%M %D, %Y %l:%i %p") AS reviewDate, invId, clientId FROM reviews WHERE invId = :invId ORDER BY reviewDate';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $inventoryReviewsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventoryReviewsArray;
}

#Get reviews by specific client
function getClientReviews($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, DATE_FORMAT(reviewDate, "%M %D, %Y %l:%i %p") AS reviewDate, invId, clientId FROM reviews WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientReviewsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientReviewsArray;
}

#Get a specific review
function getSpecificReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewArray = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
}

#Update review 
function updateReview($reviewId, $reviewText, $reviewDate, $invId, $clientId) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewId = :reviewId, reviewText = :reviewText, reviewDate = :reviewDate, invId = :invId, clientId = :clientId WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

#Delete review
function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
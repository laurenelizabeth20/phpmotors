<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

//build the navigation list using the classification array
function buildNav($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
        .urlencode($classification['classificationName']).
        "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}

function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInfo&invId="
     .urlencode($vehicle['invId']).
     "' title='View $vehicle[invMake] $vehicle[invModel]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInfo&invId="
     .urlencode($vehicle['invId']).
     "' title='View $vehicle[invMake] $vehicle[invModel]'>$vehicle[invMake] $vehicle[invModel]</a>";
     $dv .= "<span>$$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleInfo($vehicleInfo){
    $dv = "<img src='$vehicleInfo[invImage]' alt='Image of $vehicleInfo[invMake] $vehicleInfo[invModel] on phpmotors.com'>";
    $dv .= "<p class='stock'><b>In Stock: $vehicleInfo[invStock]</b></p>";
    $dv .= "<p class='color'><b>Color: $vehicleInfo[invColor]</b></p>";
    $dv .= "<span><b>Price: $vehicleInfo[invPrice]</b></span>";
    $dv .= "<p class='description'><b>$vehicleInfo[invDescription]</b></p>";
    
    return $dv;
}
?>
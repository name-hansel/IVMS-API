<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/BookedTour.php';

$database = new Database();
$db = $database->connect();

$bookedTour = new BookedTour($db);
$bookedTour->user_id = $_GET['user_id'];

$pastTourResult = $bookedTour->getCoordinatorPastTours();
$pastTourNum = $pastTourResult->rowCount();
$pastTourArray = array();
$pastTourArray['data'] = array();

if ($pastTourNum > 0) {
    while ($row = $pastTourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $pastTour_item = array(
            'btour_id' => $btour_id,
            'name' => $name,
            'company' => $company,
            'date' => $available_days,
            'booked_at' => $booked_at,
            'number_people' => $number_people,
            'rating' => $rating
        );
        array_push($pastTourArray['data'], $pastTour_item);
    }
} else {
    $message = array('message' => 'No past tours found');
    array_push($pastTourArray['data'], $message);
}

echo json_encode($pastTourArray);

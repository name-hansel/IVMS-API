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
            'tour_id' => $tour_id,
            'user_id' => $user_id,
            'date' => $available_days,
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

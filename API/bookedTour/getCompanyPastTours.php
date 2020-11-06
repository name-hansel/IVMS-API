<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/BookedTour.php';

$database = new Database();
$db = $database->connect();

$bookedTour = new BookedTour($db);
$bookedTour->company_id = $_GET['company_id'];

$pastTourResult = $bookedTour->getCompanyPastTours();
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
            'name' => $name,
            'college' => $college,
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

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

$bookedTourResult = $bookedTour->scheduledCoordinatorTour();
$bookedTourNum = $bookedTourResult->rowCount();
$bookedTourArray = array();
$bookedTourArray['data'] = array();

if ($bookedTourNum > 0) {
    while ($row = $bookedTourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $bookedTour_item = array(
            
            'tour_id' => $tour_id,
            //'user_id' => $user_id,
            'number_people' => $number_people,
            'available_days' => $available_days
        );
        array_push($bookedTourArray['data'], $bookedTour_item);
    }
} else {
    $message = array('message' => 'No booked tours found');
    array_push($bookedTourArray['data'], $message);
}

echo json_encode($bookedTourArray);

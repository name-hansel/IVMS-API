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

$bookedTourResult = $bookedTour->getCompanyBookedTours();
$bookedTourNum = $bookedTourResult->rowCount();
$bookedTourArray = array();
$bookedTourArray['data'] = array();

if ($bookedTourNum > 0) {
    while ($row = $bookedTourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $bookedTour_item = array(
            'btour_id' => $btour_id,
            'tour_id' => $tour_id,
            'user_id' => $user_id,
            'name' => $name,
            'college' => $college,
            'date' => $available_days,
            'booked_at' => $booked_at,
            'number_people' => $number_people
        );
        array_push($bookedTourArray['data'], $bookedTour_item);
    }
} else {
    $message = array('message' => 'No booked tours found');
    array_push($bookedTourArray['data'], $message);
}

echo json_encode($bookedTourArray);

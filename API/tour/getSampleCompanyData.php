<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';
include_once '../../models/BookedTour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
$bTour = new BookedTour($db);

$tour->company_id = $_GET['company_id'];
$bTour->company_id = $_GET['company_id'];

$tourResult = $tour->getSampleCompanyTourData();
$bookedTourResult = $bTour->getSampleCompanyBookedTourData();

$tourNum = $tourResult->rowCount();
$bookedTourNum = $bookedTourResult->rowCount();

$tourArray = array();
$tourArray['data'] = array();
$tourArray['data']['bookedTourData'] = array();
$tourArray['data']['tourData'] = array();


if ($tourNum > 0) {
    while ($row = $tourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tour_item = array(
            'tour_id' => $tour_id,
            'name' => $name,
            'branch' => $branch,
            'place' => $place,
            'rate' => $rate
        );
        array_push($tourArray['data']['tourData'], $tour_item);
    }
} else {
    $message = array('message' => 'No tours found');
    array_push($tourArray['data']['tourData'], $message);
}

if ($bookedTourNum > 0) {
    while ($row = $bookedTourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $bTour_item = array(
            'btour_id' => $btour_id,
            'tour_id' => $tour_id,
            'user_id' => $user_id,
            'name' => $name,
            'college' => $college,
            'available_days' => $available_days
        );
        array_push($tourArray['data']['bookedTourData'], $bTour_item);
    }
} else {
    $message = array('message' => 'No booked tours found');
    array_push($tourArray['data']['bookedTourData'], $message);
}

echo json_encode($tourArray);

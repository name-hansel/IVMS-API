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
//set company_id
// $tour->company_id = isset($_GET['company_id']) ? $_GET['company_id'] : die;

$tour->company_id = 1;
$bTour->company_id = 1;

$tourResult = $tour->getSampleCompanyTourData();
$bookedTourResult = $bTour->getSampleCompanyBookedTourData();

$tourNum = $tourResult->rowCount();
$bookedTourNum = $bookedTourResult->rowCount();

$tourArray = array();
$tourArray['bookedTourData'] = array();
$tourArray['tourData'] = array();


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
        array_push($tourArray['tourData'], $tour_item);
    }
} else {
    $message = array('message' => 'No tours found');
    array_push($tourArray['tourData'], $message);
}

if ($bookedTourNum > 0) {
    while ($row = $bookedTourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $bTour_item = array(
            'bTour_id' => $bTour_id,
            'tour_id' => $tour_id,
            'user_id' => $user_id,
            'college' => $college,
            'date' => $date
        );
        array_push($tourArray['bookedTourData'], $bTour_item);
    }
} else {
    $message = array('message' => 'No booked tours found');
    array_push($tourArray['bookedTourData'], $message);
}

echo json_encode($tourArray);
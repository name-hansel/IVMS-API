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
$btour = new BookedTour($db);
//set company_id
// $tour->company_id = isset($_GET['company_id']) ? $_GET['company_id'] : die;

$tour->company_id = 1;
$btour->company_id = 1;

$result = $tour->getSampleTourData();
$result2 = $btour->getSampleBookedTourData();

$num = $result->rowCount();
$num2 = $result2->rowCount();

$tours_arr = array();
if ($num > 0) {
    $tours_arr['tourdata'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tour_item = array(
            'tour_id' => $tour_id,
            'name' => $name,
            'branch' => $branch,
            'place' => $place,
            'rate' => $rate
        );
        array_push($tours_arr['tourdata'], $tour_item);
    }
} else {
    //no tours 
    echo json_encode(
        array('message' => 'No tours found')
    );
}

if ($num2 > 0) {
    $tours_arr['bookedtourdata'] = array();
    while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $btour_item = array(
            'btour_id' => $btour_id,
            'tour_id' => $tour_id,
            'user_id' => $user_id,
            'college' => $college,
            'date' => $date
        );
        array_push($tours_arr['bookedtourdata'], $btour_item);
    }
} else {
    //no tours 
    echo json_encode(
        array('message' => 'No booked tours found')
    );
}

echo json_encode($tours_arr);

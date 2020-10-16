<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
$tour->company_id = 1;

$tourResult = $tour->getCompanyTours();
$tourNum = $tourResult->rowCount();
$tourArray = array();
$tourArray['data'] = array();

if ($tourNum > 0) {
    while ($row = $tourResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tour_item = array(
            'tour_id' => $tour_id,
            'name' => $name,
            'branch' => $branch,
            'available_days' => $available_days,
            'place' => $place,
            'number_people' => $number_people,
            'rate' => $rate,
            'description' => $description,
            'avg_rating' => $avg_rating
        );
        array_push($tourArray['data'], $tour_item);
    }
} else {
    $message = array('message' => 'No tours found');
    array_push($tourArray['data'], $message);
}

echo json_encode($tourArray);

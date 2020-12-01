<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

// TODO change variable casing, change array name from post_arr to tourArray and post_item to tourItem

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
$tour->user_id = $_GET['user_id'];
$result = $tour->getFromTour();
$num = $result->rowcount();

$tourArray = array();
$tourArray['data'] = array();
$tourArray['data']['tourData'] = array();
$tourArray['data']['bookedTourData'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tourItem = array(
            'tour_id' => $tour_id,
            'name' => $name,
            'branch' => $branch,
            'available_days' => $available_days,
            'place' => $place,
            'rate' => $rate,
            'description' => $description,
            'avg_rating' => $avg_rating
        );

        array_push($tourArray['data'], $tourItem);
    }
    echo json_encode($tourArray);
} else {
    echo json_encode(
        array('message ' => 'No tours found')
    );
}

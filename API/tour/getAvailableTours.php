<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
$result = $tour->getAvailableTours();
$num = $result->rowcount();

$tourArray = array();
$tourArray['data'] = array();
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
        );

        array_push($tourArray['data'], $tourItem);
    }
    echo json_encode($tourArray);
} else {
    echo json_encode(
        array('message' => 'No tours found')
    );
}

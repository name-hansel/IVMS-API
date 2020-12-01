<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
$tour->tour_id = $_GET['tour_id'];

$result = $tour->getTourDetails();
$num = $result->rowCount();

$tourArray = array();
$tourArray['tourData'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tourItem = array(
            'name' => $name,
            'branch' => $branch,
            'place' => $place,
            'number_people' => $number_people,
            'available_days' => $available_days,
            'description' => $description,
            'rate' => $rate
        );
        array_push($tourArray['tourData'], $tourItem);
    }
    echo json_encode($tourArray['tourData']);
} else {
    $message = array('message' => 'No tour found');
    array_push($tourArray['tourData'], $message);
}

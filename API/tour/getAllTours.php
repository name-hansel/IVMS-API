<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);

$result = $tour->getAllTours();
$num = $result->rowCount();

$tour_arr = array();
$tour_arr['tourData'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tour_item = array(
            'name' => $name,
            'branch' => $branch,
            'company_id' => $company_id,
            'place' => $place,
            'description' => $description,
            'avg_rating' => $avg_rating
        );
        array_push($tour_arr['tourData'], $tour_item);
    }
    echo json_encode($tour_arr['tourData']);
} else {
    //no tour 
    $message = array('message' => 'No tours found');
    array_push($tour_arr['tourData'], $message);
}

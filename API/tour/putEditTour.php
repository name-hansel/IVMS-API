<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    die();
}

include_once '../../config/Database.php';
include_once '../../models/Tour.php';
$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$tour->tour_id = $data->tour_id;
$tour->name = $data->name;
$tour->branch = $data->branch;
$tour->available_days = $data->available_days;
$tour->place = $data->place;
$tour->number_people = $data->number_people;
$tour->rate = $data->rate;
$tour->description = $data->description;

if ($tour->putEditTour()) {
    echo json_encode(
        array('message' => 'Tour edited')
    );
} else {
    echo json_encode(
        array('message' => 'Tour not edited')
    );
}

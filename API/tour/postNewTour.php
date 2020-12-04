<?php
// Headers
header('Access-Control-Allow-Origin: https://industrialvisit-ms.herokuapp.com');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$tour->name = $data->name;
$tour->branch = $data->branch;
$tour->company_id = $data->company_id;
$tour->available_days = $data->available_days;
$tour->place = $data->place;
$tour->number_people = $data->number_people;
$tour->rate = $data->rate;
$tour->description = $data->description;

if ($tour->postNewTour()) {
    echo json_encode(
        array('message' => 'Tour Created')
    );
} else {
    echo json_encode(
        array('message' => 'Tour Not Created')
    );
}

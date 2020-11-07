<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/BookedTour.php';

$database = new Database();
$db = $database->connect();

$bookedTour = new BookedTour($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$bookedTour->tour_id = $data->tour_id;
$bookedTour->user_id = $data->user_id;
$bookedTour->number_people = $data->number_people;

if ($bookedTour->scheduledCoordinatorTour()) {
    echo json_encode(
        array('message' => 'Record Created')
    );
} else {
    echo json_encode(
        array('message' => 'Record Not Created')
    );
}

<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/scheduledCoordinatorTour.php';

$database = new Database();
$db = $database->connect();

$scheduledCoordinatorTour = new scheduledCoordinatorTour($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$scheduledCoordinatorTour->btour_id = $data->btour_id;
$scheduledCoordinatorTour->tour_id = $data->tour_id;
$scheduledCoordinatorTour->user_id = $data->user_id;
$scheduledCoordinatorTour->number_people = $data->number_people;
$scheduledCoordinatorTour->date = $data->date;
$scheduledCoordinatorTour->rating = $data->rating;

if ($scheduledCoordinatorTour->postCoordinatorBookedTour()) {
    echo json_encode(
        array('message' => 'Record Created')
    );
} else {
    echo json_encode(
        array('message' => 'Record Not Created')
    );
}

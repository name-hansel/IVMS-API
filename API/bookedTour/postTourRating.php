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

$bookedtour = new BookedTour($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$bookedtour->rating = $data->rating;
if ($bookedtour->postTourRating()) {
    echo json_encode(
        array('message' => 'Ratings Stored.')
    );
} else {
    echo json_encode(
        array('message' => 'Ratings Not Stored')
    );
}

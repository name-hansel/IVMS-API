<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$tour = new Tour($db);
$tour->tour_id = $_GET['tour_id'];

if ($tour->deleteTour()) {
    echo json_encode(
        array('message' => 'Tour deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Tour Not deleted')
    );
}

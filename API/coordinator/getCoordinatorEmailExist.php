<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Coordinator.php';

$database = new Database();
$db = $database->connect();

$coordinator = new Coordinator($db);
$coordinator->email = $_GET['email'];

$coordinatorResult = $coordinator->getCoordinatorEmailExist();
$coordinatorNum = $coordinatorResult->rowCount();
$coordinatorArray = array();

if ($coordinatorNum > 0) {
    $message = array(
        'exist' => TRUE
    );
    array_push($coordinatorArray, $message);
} else {
    $message = array('exist' => false);
    array_push($coordinatorArray, $message);
}

echo json_encode($coordinatorArray);

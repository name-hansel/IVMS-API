<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Coordinator.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$coordinator = new Coordinator($db);
$coordinator->email = $_GET['email'];

$coordinatorResult = $coordinator->getHashCoordinator();
$coordinatorNum = $coordinatorResult->rowCount();

$coordinatorArray = array();
$coordinatorArray['data'] = array();

if ($coordinatorNum > 0) {
    while ($row = $coordinatorResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $coordinator_item = array(
            'user_id' => $user_id,
            'password' => $password
        );
        array_push($coordinatorArray['data'], $coordinator_item);
    }
} else {
    $message = array('message' => 'No coordinator found');
    array_push($coordinatorArray['data'], $message);
}

echo json_encode($coordinatorArray);

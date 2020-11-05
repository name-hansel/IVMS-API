<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Coordinator.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$coordinator = new Coordinator($db);
// get email address of the user trying to login
$data = json_decode(file_get_contents("php://input"));
$coordinator->email = $data->email;

$coordinatorResult = $coordinator->getHashCoordinator();
$coordinatorNum = $coordinatorResult->rowCount();

$coordinatorArray = array();
$coordinatorArray['data'] = array();

if ($coordinatorNum > 0) {
    while ($row = $coordinatorResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $coordinator_item = array(
            'password' => $password
        );
        array_push($coordinatorArray['data'], $coordinator_item);
    }
} else {
    $message = array('message' => 'No coordinator found');
    array_push($coordinatorArray['data'], $message);
}

echo json_encode($coordinatorArray);

<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Coordinator.php';
$database = new Database();
$db = $database->connect();

$coordinator = new Coordinator($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$coordintor->email = $data->email;
$coordintor->phone_number = $data->phone_number;
$coordintor->college = $data->college;
$coordintor->user_id = $data->user_id;

if ($company->putCoordinatorDetails()) {
    echo json_encode(
        array('message' => 'Coordinator details updated')
    );
} else {
    echo json_encode(
        array('message' => 'Coordinator details not updated')
    );
}

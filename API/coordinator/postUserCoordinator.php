<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Coordinator.php';

$database = new Database();
$db = $database->connect();

$coordinator = new Coordinator($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$coordinator->email = $data->email;
$coordinator->password = $data->password;
$coordinator->phone_number = $data->phone_number;
$coordinator->college = $data->college;

if ($coordinator->postUserCoordinator()) {
    echo json_encode(
        array('message' => 'successful')
    );
} else {
    echo json_encode(
        array('message' => 'unsuccessful')
    );
}

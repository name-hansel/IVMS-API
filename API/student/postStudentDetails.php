<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/studentDetails.php';

$database = new Database();
$db = $database->connect();

$student = new studentDetils($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$student->student_id = $data->student_id;
$student->user_id = $data->user_id;
$student->name = $data->name;
$student->email = $data->email;
$student->phone_number = $data->phone_number;
$student->branch = $data->branch;


if ($student->postStudentDetails()) {
    echo json_encode(
        array('message' => 'Student profile Created')
    );
} else {
    echo json_encode(
        array('message' => 'Student profile not Created')
    );
}

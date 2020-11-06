<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));


$company->email = $data->email;
$company->password = $data->password;
$company->phone_number = $data->phone_number;
$company->company = $data->company;
$company->description = $data->description;

if ($company->postUserCompany()) {
    echo json_encode(
        array('message' => 'company Created')
    );
} else {
    echo json_encode(
        array('message' => 'company Not Created')
    );
}

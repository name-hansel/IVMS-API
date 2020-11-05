<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Company.php';
$database = new Database();
$db = $database->connect();

$company = new Company($db);
//decode posted data
$data = json_decode(file_get_contents("php://input"));

$company->password = $data->password;
$company->company_id = $data->company_id;

if ($company->putCompanyHash()) {
    echo json_encode(
        array('message' => 'Company password changed.')
    );
} else {
    echo json_encode(
        array('message' => 'Company password not changed')
    );
}

<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$result = $company->getAllCompanies();
$num = $result->rowCount();

$company_arr = array();
$company_arr['data'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $company_item = array(
            'company_id' => $company_id,
            'email' => $email,
            'phone_number' => $phone_number,
            'company' => $company,
            'description' => $description
        );
        array_push($company_arr['data'], $company_item);
    }
    echo json_encode($company_arr);
} else {
    //no company 
    $message = array('message' => 'No companies found');
    array_push($company_arr['data'], $message);
    echo json_encode($company_arr['data']);
}

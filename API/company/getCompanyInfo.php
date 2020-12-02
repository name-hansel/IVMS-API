<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

$company = new Company($db);
$company->company_id = $_GET['company_id'];

$companyResult = $company->getCompanyInfo();
$companyNum = $companyResult->rowCount();

$companyArray = array();
$companyArray['data'] = array();

if ($companyNum > 0) {
    while ($row = $companyResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $company_item = array(
            'name' => $company,
            'phone_number' => $phone_number,
            'description' => $description
        );
        array_push($companyArray['data'], $company_item);
    }
} else {
    $message = array('message' => 'No company found');
    array_push($companyArray['data'], $message);
}

echo json_encode($companyArray);

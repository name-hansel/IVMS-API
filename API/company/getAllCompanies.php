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

$companyArray = array();
$companyArray['data'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $companyItem = array(
            'company_id' => $company_id,
            'email' => $email,
            'phone_number' => $phone_number,
            'company' => $company,
            'description' => $description
        );
        array_push($companyArray['data'], $companyItem);
    }
    echo json_encode($companyArray);
} else {
    //No company 
    $message = array('message' => 'No companies found');
    array_push($companyArray['data'], $message);
    echo json_encode($companyArray['data']);
}

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

if ($num > 0) {
    $company_arr = array();
    $company_arr['companyData'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $company_item = array(
            'company_id' => $company_id,
            'email' => $email,
            'phone_number' => $phone_number,
            'company' => $company,
            'description' => $description
        );
        echo ($company_item);
        array_push($company_arr['companyData'], $company_item);
    }
    echo json_encode($company_arr);
} else {
    //no company 
    echo json_encode(
        array('message' => 'No company found')
    );
}

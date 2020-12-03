<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);
$company->email = $_GET['email'];

$companyResult = $company->getCompanyEmailExist();
$companyNum = $companyResult->rowCount();
$companyArray = array();

if ($companyNum > 0) {
    $message = array(
        'exist' => TRUE
    );
    array_push($companyArray, $message);
} else {
    $message = array('exist' => false);
    array_push($companyArray, $message);
}

echo json_encode($companyArray);

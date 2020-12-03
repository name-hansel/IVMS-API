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


$result = $company->getHomeCompany();
$num = $result->rowCount();

if ($num > 0) {
    $companyArray = array();
    $companyArray['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $companyItem = array(
            'company' => $company
        );
        array_push($companyArray['data'], $companyItem);
    }
    echo json_encode($companyArray);
} else {
    echo json_encode(
        array('message' => 'No Companies Found')
    );
}

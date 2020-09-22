<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$result = $company->getAllComapnies();

$num = $result->rowCount();

if ($num > 0) {
    $comp_arr['compdata'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $comp_item = array(
            'company_id' => $company_id,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number,
            'company' => $company,
            'description' => $description
        );
        array_push($comp_arr['compdata'], $comp_item);
    }
    echo json_encode($comp_arr);
    
} else {
    //no company 
    echo json_encode(
        array('message' => 'No company found')
    );
}
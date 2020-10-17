<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Company.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate post query
$company = new Company($db);

//post query
$result = $company->getHomeData();
//Get row count
$num = $result->rowCount();

//check if any posts
if ($num > 0) {
    //Post array
    $companyArray = array();
    $companyArray['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);


        $post_item = array(
            'company' => $company,
            'description' => $description
        );
        array_push($companyArray['data'], $post_item);
    }
    echo json_encode($companyArray);
} else {
    echo json_encode(
        array('message' => 'No Companies Found')
    );
}
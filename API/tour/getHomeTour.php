<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();
$tour = new Tour($db);


$result = $tour->getHomeTour();
$num = $result->rowCount();

if ($num > 0) {
    $tourArray = array();
    $tourArray['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $tourItem = array(
            'name' => $name,
            'branch' => $branch,
            'date' => $available_days
        );
        array_push($tourArray['data'], $tourItem);
    }
    echo json_encode($tourArray);
} else {
    echo json_encode(
        array('message' => 'No tour Found')
    );
}

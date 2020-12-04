<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/BookedTour.php';

$database = new Database();
$db = $database->connect();

$btour = new BookedTour($db);

$result = $btour->getInfoPastTours();
$num = $result->rowCount();

$btour_arr = array();
$btour_arr['btourData'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $btour_item = array(
            'btour_id' => $btour_id,
            'college' => $college,
            'name' => $name,
            'company' => $company,
            'number_people' => $number_people,
            'rating' => $rating,
            'date' => $date
        );
        array_push($btour_arr['btourData'], $btour_item);
    }
} else {
    //no tour 
    $message = array('message' => 'No tours found');
    array_push($btour_arr['btourData'], $message);
}

echo json_encode($btour_arr['btourData']);

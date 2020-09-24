<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tour.php';

$database = new Database();
$db = $database->connect();

$post = new Tour($db);

$result = $post->getFromTour();
$num = $result->rowcount();

$post_arr = array();
$post_arr['data'] = array();
if ($num > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'tour_id' => $tour_id,
            'name' => $name,
            'branch' => $branch,
            'available_days' => $available_days,
            'place' => $place,
            'rate' => $rate,
            'description' => $description,
            'avg_rating' => $avg_rating
        );

        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    echo json_encode(
        array('message ' => 'No tours found')
    );
}

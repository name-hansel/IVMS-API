<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Company.php';

    //Instantiate DB and connect
    $database= new Database();
    $db= $database->connect();

    //Instantiate post query
    $post = new Company($db);

    //post query
    $result=$post->getHomeData();
    //Get row count
    $num = $result->rowCount();

    //check if any posts
    if($num> 0) {
        //Post array
        $posts_arr = array();
        $posts_arr['data']= array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            

            $post_item = array(
                'company' => $company,
                'description' => $description
            );

            //Push to "data"
            array_push($posts_arr['data'], $post_item);
        }

        //Turn to json and output
        echo json_encode($posts_arr);

    } else {
        //No Posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );

    }


<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Coordinator.php';

    //Instantiate DB and connect
    $database= new Database();
    $db= $database->connect();
    $coordinator = new Coordinator($db);

    
    $result = $coordinator->getHashCoordinator();
    $num = $result->rowCount();

    if($num> 0) {
        $coordinatorArray = array();
        $coordinatorArray['data']= array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $coordinatorItem = array(
                'email' => $email,
                'password' => $password
            );
            array_push($coordinatorArray['data'], $coordinatorItem);
        }
        echo json_encode($coordinatorArray);

    } else {
        echo json_encode(
            array('message' => 'No coordinator Found')
        );

    }
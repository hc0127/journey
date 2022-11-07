<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/JourneyToken.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $token = new JourneyToken($db);
        
        if(isset($_GET)) {
            if($token->getJourneyToken($_GET)) {
                print_r(json_encode(array(
                    'JourneyId' => $token->journeyId,
                    'inventory' => $token->inventory,
                    'General1' => $token->general1,
                    'General2' => $token->general2
                ),true));
                $token->setJourneyTokenUsed($_GET);
            } else {
                echo json_encode(array('message' => "No records found!"));
            }
        } else {
            echo json_encode(array('message' => "Error: data is missing!"));
        }
    } else {
        echo json_encode(array('message' => "Error: incorrect Method!"));
    }
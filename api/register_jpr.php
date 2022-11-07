<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/JourneyPost.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $db = new Database();
        $db = $db->connect();

        $post = new JourneyPost($db);
        
        if(isset($_GET) && isset($_POST)) {
            if($post->registerJourneyPost($_GET,$_POST)) {
                echo json_encode(array('Error' => 0));
            }
        } else {
            echo json_encode(array('Error' => 1,'message' => "Error: Data is missing!"));
        }
    } else {
        echo json_encode(array('Error' => 1,'message' =>"Error: Incorrect Method!"));
    }
?>
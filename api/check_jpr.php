<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/JourneyPost.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $post = new JourneyPost($db);
        
        if(isset($_GET)) {
            if($post->checkJourneyPost($_GET)) {
                print_r(json_encode(array(
                    'Result' => $post->result1,
                    'reviewComment' => $post->reviewComment,
                ),true));
            }else{
                echo json_encode(array('Error' => 1,'message' => "Error: Data is missing!"));
            }
        } else {
            echo json_encode(array('Error' => 1,'message' => "Error: Incorrect Method!"));
        }
    } else {
    }
?>
<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Admin.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $db = new Database();
        $db = $db->connect();

        $admin = new Admin($db);
        
        if(isset($_GET)) {
            if($admin->modifyJourneyPosts($_GET,$_POST)) {
                print_r(array(
                    'state'=>'success'
                ));
            } else {
                echo json_encode(array(
                    'state'=>'error','message' => "Error: No data!"));
            }
        } else {
            echo json_encode(array(
                'state'=>'error','message' => "Error: confirm is missing!"));
        }
    } else {
        echo json_encode(array(
            'state'=>'error','message' => "Error: incorrect Method!"));
    }
<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Admin.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $admin = new Admin($db);
        
        if(isset($_GET)) {
            if($admin->checkAdmin($_GET)) {
                print_r(json_encode(array(
                    'state'=>'success',
                ),true));
            } else {
                echo json_encode(array(
                    'state'=>'error','message' => "Error: No user or wrong password!"));
            }
        } else {
            echo json_encode(array(
                'state'=>'error','message' => "Error: confirm is missing!"));
        }
    } else {
        echo json_encode(array(
            'state'=>'error','message' => "Error: incorrect Method!"));
    }
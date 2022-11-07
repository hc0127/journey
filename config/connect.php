<?php
    $dbname = "turskattonline01";

    $servername = "localhost";
    $username = "root";
    $password = "";
    
    // $servername = "turskattonline01.mysql.domeneshop.no";
    // $username = "turskattonline01";
    // $password = "ball-Egget-meie-0jet";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM administrator";
    $userlist    = $conn->query($sql);
    
    $sql = "SELECT * FROM `journeypostregistration` WHERE active = 1 ";
    $posts    = $conn->query($sql);

    $sql = "SELECT * FROM `journeytokenlogin` ORDER BY created DESC limit 200";
    $logins    = $conn->query($sql);
?>
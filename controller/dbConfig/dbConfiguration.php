<?php

    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $db_name = "theemwiz_db";

    header("Content-type:application/json");
    // Enable CORS
    header("Access-Control-Allow-Origin: *"); // Replace * with your specific domain or origins

    // Other necessary headers
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $conn = mysqli_connect($server_name, $user_name, $password, $db_name);

    if(!$conn){
        die("Connection failed : ". mysqli_connect_error());
    }
?>
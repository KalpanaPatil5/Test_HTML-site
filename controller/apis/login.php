<?php
    require "../dbConfig/dbConfiguration.php";

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //check whether the user is valid & verified
    if(!empty($email) && !empty($password)){
        $select_qry = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password' AND
                    `verified_status` = '1'";
        $run_select_qry = mysqli_query($conn, $select_qry);
        $user_result = mysqli_fetch_assoc($run_select_qry);

        if($user_result){
            $response = array(
                "status" => true,
                "message" => "Login successful.",
                "data" => $user_result
            );
        } else {
            $response = array(
                "status" => false,
                "message" => "Invalid email or password."
            );
        }
    } else {
        $response = array(
            "status" => false,
            "message" => "Email & password required."
        );
    }
    echo json_encode($response);
?>
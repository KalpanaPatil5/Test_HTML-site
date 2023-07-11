<?php
    require "../dbConfig/dbConfiguration.php";
    require_once 'function_mail_template.php';

    //declaring variables for taking user inputs for registration
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    //md5 encryption for password protection
    $password = md5($_POST['password']);
    //generating unique token of 64 bytes for every new user
    $token = bin2hex(random_bytes(64)).time();

    //condition check if the user enters all details
    if(!empty($first_name) && !empty($last_name) && !empty($phone) && !empty($email) && !empty($password)){
        //if user enters all details then slecting the user based on email
        $select_qry = "SELECT * FROM `user` WHERE `email` = '$email'";

        //running select query
        $run_select_qry = mysqli_query($conn, $select_qry);

        //fetching the associated user details based on email
        $user_result = mysqli_fetch_assoc($run_select_qry);

        //checking if the user already exists
        //if user does not exist, then registering the new user
        if(!$user_result){
            $insert_user = "INSERT INTO `user` (`first_name`, `last_name`, `phone`, `email`, `password`, `token`, `verified_status`) VALUES ('$first_name', '$last_name', '$phone', '$email', '$password', '$token', '0')";
            //inserting verified_status as '0' while registering; which will be updated later to '1' after verification

            //running insert query
            $run_insert_user = mysqli_query($conn, $insert_user);
            $user_id = mysqli_insert_id($conn);
            
            //filetering newly registered user mail id
            $new_user = "SELECT `id`, `first_name`, `first_name`, `email`, `token` FROM `user` WHERE `id` = '$user_id'";
            $run_new_user = mysqli_query($conn, $new_user);
            $new_user_result = mysqli_fetch_assoc($run_new_user);

            //filtering new user email and assigning to new variable
            $new_user_email = $new_user_result['email'];
            $new_user_token = $new_user_result['token'];
            
            //invoking sendMail function by passing required parameters
            sendMail($user_id, $new_user_email, $new_user_token);

            //cheching if insert query is executed
            if($run_insert_user){
                $response = array(
                    "status" => true,
                    "message" => "User registered successfully.",
                    "data" => $new_user_result
                );
            } else {
                $response = array(
                    "status" => false,
                    "message" => "Something went wrong."
                );
            }
        } else {
            $response = array(
                "status" => false,
                "message" => "User already exist."
            );
        }
    } else {
        $response = array(
            "status" => false,
            "message" => "Please enter all fields"
        );
    }

    //printing the respective response array based on the condition executed
    echo json_encode($response);  
?>
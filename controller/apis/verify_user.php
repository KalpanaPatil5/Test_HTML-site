<?php
    require "../dbConfig/dbConfiguration.php";

    // Retrieve the token from the request parameters
    $token = $_GET['token'];
    
    // Check if the token is valid
    $select_query = "SELECT * FROM `user` WHERE `token` = '$token'";
    $result = mysqli_query($conn, $select_query);
    
    // If a user with the specified token is found, update their verified_status to 1
    if (mysqli_num_rows($result) > 0) {
        $update_query = "UPDATE `user` SET `verified_status` = 1 WHERE `token` = '$token'";
        $update_result = mysqli_query($conn, $update_query);
    
        if ($update_result) {
            // Redirect the user to a success page
            header("Location: http://127.0.0.1:5501/index.html?token=".$token);
            $response = array(
                            "status" => true,
                            "message" => "User verified successfully."
                        );
            exit();
        } else {
            // Redirect the user to an error page
            header("Location: http://localhost/Test%20HTML%20site/error.html");
            $response = array(
                            "status" => false,
                            "message" => "Something went wrong."
                        );
            exit();
        }
    } else {
        // Redirect the user to an invalid user page
        header("Location: http://localhost/Test%20HTML%20site/invalid_user.html");
        $response = array(
                    "status" => false,
                    "message" => "Invalid user."
                );
        exit();
    }
    echo json_encode($response);
?>
<?php
    require "../dbConfig/dbConfiguration.php";

    //taking user inputs for editing
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);

    //validation to avoid empty inputs
    if(!empty($user_id) && !empty($first_name) && !empty($last_name) && !empty($phone) && !empty($password)){

        //query to select the user based on id
        $select_user = "SELECT * FROM user WHERE id = '$user_id'";
        $run_select_user = mysqli_query($conn, $select_user);
        $user_result = mysqli_fetch_assoc($run_select_user);

        if($user_result){
            //updating the user based on id
            $update_qry = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', password = '$password' WHERE id = '$user_id'";
            $run_update_qry = mysqli_query($conn, $update_qry);

            if($run_update_qry){
                $response = array(
                    "status" => true,
                    "message" => "User updated successfully.."
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
                "message" => "Invalid user."
            );
        }
    } else {
        $response = array(
            "status" => false,
            "message" => "Please provide all fields."
        );
    }
    echo json_encode($response);
?>
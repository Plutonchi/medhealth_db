<?php

require "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    # code...
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query_cek_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");
    $cek_user_result = mysqli_fetch_array($query_cek_user);

    if ($cek_user_result) {
        # code...
        $query_login = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' && password= '$password'");


        if ($query_login) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Yeah, LogIn is successfull.";
            $response['user_id'] = $cek_user_result['id_user'];
            $response['name'] = $cek_user_result['name'];
            $response['email'] = $cek_user_result['email'];
            $response['phone'] = $cek_user_result['phone'];
            $response['address'] = $cek_user_result['address'];
            $response['created_at'] = $cek_user_result['created_at'];

            $response['message'] = "Yeah, LogIn is successfull.";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 2;
            $response['message'] = "Oops, LogIn failed";
            echo json_encode($response);
        }
    } else {
        # code...
        $response['value'] = 2;
        $response['message'] = "Oops, Data is registered !";
        echo json_encode($response);
    }
}

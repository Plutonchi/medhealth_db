<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = array();
    $id_device = $_POST['id_device'];
    $id_product = $_POST['id_product'];
    $cekCart = mysqli_query($connection, "SELECT * FROM cart WHERE id_device = '$id_device'AND id_product = '$id_product'");
    $resultCekCart = mysqli_fetch_array($cekCart);
    if ($resultCekCart) {
        # code...
        $response['value'] = 2;
        $response['message'] = "Sorry, the product is already in the cart";
        echo json_encode($response);
    } else {
        $cekProduct = mysqli_query($connection,  "SELECT * FROM product WHERE id_product = '$id_product'");
        $fetchProduct = mysqli_fetch_array($cekProduct);
        $fetchPrice = $fetchProduct['price'];
        $insertToCart = "INSERT INTO cart VALUE('', '$id_device', '$id_product',1,'$fetchPrice',NOW())";
        if (mysqli_query($connection, $insertToCart)) {
            # code...
            $response['value'] = 1;
            $response['message'] = "Yeah, product added to cart success";
            echo json_encode($response);
        } else {
            # code...
            $response['value'] = 0;
            $response['message'] = "Sorry, added product failed";
            echo json_encode($response);
        }
    }
}

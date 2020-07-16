<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/17
 * Time: 10:58 PM
 */
require_once 'include/DB_Function.php';
$db = new DB_Functions();

// response array
$response = array("error" => false);

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['company'])) {
    // receiving post parameters
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $company = $_POST['company'];
    $latitude = $_POST['lat'];
    $longitude = $_POST['lon'];

    // check if a registration already exists with that registration number
    if ($db->isServiceCenter($name, $phone, $email)){
        // service center already registered
        $response["error"] = true;
        $response["error-msg"] = "A service center is already registered with that name, phone and email.";
        echo json_encode($response);
    } else {
        // register the service center
        if ($service_center = $db->createServiceCenter($name, $email, $phone, $address, $company, $latitude, $longitude)) {
            // successfully registered
            $response["error"] = false;
            $response["service_center"] = $service_center;
            $response["message"] = "The service center was registered successfully.";
            echo json_encode($response);
        } else {
            // some error registering the car
            $response["error"] = true;
            $response["error-msg"] = "Error! Please try again later.";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = true;
    $response["error-msg"] = "Please enter all the details!";
}
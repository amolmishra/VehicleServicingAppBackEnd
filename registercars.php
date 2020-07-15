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

if (isset($_POST['name']) && isset($_POST['model']) && isset($_POST['regno']) && isset($_POST['username'])) {
    // receiving post parameters
    $name = $_POST['name'];
    $model = $_POST['model'];
    $regno = $_POST['regno'];
    $username = $_POST['username'];

    // check if a registration already exists with that registration number
    if ($db->isCar($regno)){
        // car already registered
        $response["error"] = true;
        $response["error-msg"] = "A car is already registered with that Registration Number";
        echo json_encode($response);
    } else {
        // register the car
        if ($car = $db->registerCar($name, $model, $regno, $username)) {
            // successfully registered
            $response["error"] = false;
            $response["car"] = $car;
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
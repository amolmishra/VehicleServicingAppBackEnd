<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/5/17
 * Time: 5:42 PM
 */

require_once 'include/DB_Function.php';
$db = new DB_Functions();

//json response array
$response = array("error" => false);

if (isset($_POST['registered_car_id'])) {
    $registered_car_id = $_POST['registered_car_id'];

    if ($db->deleteCar($registered_car_id)) {
        $response["error"] = false;
    } else {
        $response["error"] = true;
    }
} else {
    $response["error"] = true;
    $response["error-msg"] = "Please Enter Registration Number";
}

echo json_encode($response);
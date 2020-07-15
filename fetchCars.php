<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/5/17
 * Time: 11:42 PM
 */
require_once 'include/DB_Function.php';

// response array
$response = array("error" => false);

// database
$db = new DB_Functions();

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $cars = $db->getCars($username);
    if ($cars != null) {
        $response['cars'] = $cars;
        echo json_encode($response);
    } else {
        $response['error'] = true;
        $response['error-msg'] = "No cars Registered yet.";
        echo json_encode($response);
    }
} else {
    $response['error'] = true;
    $response['error-msg'] = "Username not available";
}
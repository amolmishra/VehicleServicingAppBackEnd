<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/17
 * Time: 11:18 PM
 */

require_once 'include/DB_Function.php';
$db = new DB_Functions();

// response array 
$response = array("error" => false);

if (isset($_POST['username'])) {
    // receive the parameter
    $username = $_POST['username'];

    // find the appointment
    $appointments = $db->allAppointments($username);

    if ($appointments != null) {
        $response["error"] = false;
        $response["appointments"] = $appointments;
        echo json_encode($response);
    } else {
        $response["error"] = true;
        $response["error-msg"] = "No appointments yet";
        echo json_encode($response);
    }
    
} else {
    $response["error"] = true;
    $response["error-msg"] = "Details are not Known";
    echo json_encode($response);
}
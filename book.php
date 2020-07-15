<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/17
 * Time: 9:36 PM
 */
require_once 'include/DB_Function.php';
$db = new DB_Functions();

//json response array
$response = array("error" => false);

if (isset($_POST['username']) && isset($_POST['registered_car_id']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['centerid']) && isset($_POST['pickup'])) {
    
    // receiving post parameters
    $username = $_POST['username'];
    $carid = $_POST['registered_car_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $centerid = $_POST['centerid'];
    $pickup = $_POST['pickup'];
    
    // check if an appointment has already been registered on the same day
    if ($db->isBooking($username, $carid, $date)) {
        // appointment already exists
        $response["error"] = true;
        $response["error-msg"] = "Appointment already exists for the same car on the same date";
        echo json_encode($response);
    } else {
        // create new appointment
        // if charges are available create using charges
        if (isset($_POST['charges'])) {
            // if appointment created using charges
            if ($db->createAppointment($username, $carid, $date, $time, $centerid, $pickup, $_POST['charges'])) {
                // appointment created successfully
                $response["error"] = false;
                $response["message"] = "Appointment Created with the charges";
                echo json_encode($response);
            } else {
                $response["error"] = true;
                $response["error-msg"] = "Problen in creating an Appointment.";
                echo json_encode($response);
            }
        } else {
            // creating appointment without charges
            if ($db->createAppointmentWithoutCharges($username, $carid, $date, $time, $centerid, $pickup)) {
                // appointment created without charges
                $response["error"] = false;
                $response["message"] = "Appointment Created Successfully";
                echo json_encode($response);
            } else {
                $response["error"] = true;
                $response["error-msg"] = "Problem in creating an Appointment.";
                echo json_encode($response);
            }
        }
    }
} else {
    $response["error"] = true;
    $response["error-msg"] = "Please Enter all the Details";
    echo json_encode($response);
}
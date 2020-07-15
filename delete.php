<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/5/17
 * Time: 6:10 PM
 */

require_once 'include/DB_Function.php';
$db = new DB_Functions();

//json response array
$response = array("error" => false);

if (isset($_POST['username']) && isset($_POST['serviceid'])) {

    // receiving the post params
    $username = $_POST['username'];
    $serviceid = $_POST['serviceid'];

    if ($db->deleteHistory($username, $serviceid)) {
        $response["error"] = false;
    } else {
        $response["error"] = true;
    }
} else {
    $response["error"] = true;
}

echo json_encode($response);
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/5/17
 * Time: 6:36 PM
 */
require_once 'include/DB_Function.php';
$db = new DB_Functions();

// response array
$response = array("error" => false);

$response["centers"] = $db->getAllServiceCenters();

if ($response["centers"] != null) {
    echo json_encode($response);
} else {
    $response['error'] = true;
    $response['error-msg'] = "Cannot access the Database";
    echo json_encode($response);
}

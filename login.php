<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/3/20
 * Time: 12:52 AM
 */
require_once 'include/DB_Function.php';
$db = new DB_Functions();

// json response array
$response = array("error" => false);

if (isset($_POST['username']) && isset($_POST['password'])) {

    // receiving the post params
    $username = $_POST['username'];
    $password = $_POST['password'];

    // get the user by username and password
    $user = $db->getUserByUsernameAndPassword($username, $password);

    if ($user != null && $user != false) {
        // user is found
        $response["error"] = false;
        $response["user"]["id"] = $user["id"];
        $response["user"]["name"] = $user["name"];
        $response["user"]["username"] = $user["username"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["lat"] = $user["lat"];
        $response["user"]["lon"] = $user["lon"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = true;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = true;
    $response["error_msg"] = "Required parameteres email or password is missing!";
    echo json_encode($response);
}
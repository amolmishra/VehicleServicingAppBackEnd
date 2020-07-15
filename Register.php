<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/3/17
 * Time: 12:30 AM
 */
require_once 'include/DB_Function.php';
$db = new DB_Functions();

//json response array
$response = array("error" => false);

if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

    //receiving post parameters
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $latitude = $_POST['lat'];
    $longitude = $_POST['lon'];

    //check if user is already exists with the same email
    if ($db->isUser($email, $username)) {
        // user already exists
        $response["error"] = true;
        $response["error-msg"] = "user already exits with this email or username";
        echo json_encode($response);
    } else {
        //create new user
        $user = $db->storeUser($name, $username, $email, $password, $latitude, $longitude);
        if ($user) {
            // user stored successfully
            $response["error"] = false;
            $response["user"]["id"] = $user["id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["username"] = $user["username"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["lat"] = $user["lat"];
            $response["user"]["lon"] = $user["lon"];
            echo json_encode($response);
        }else {
            // registration failure due to some other reason
            $response["error"]=true;
            $response["error-msg"]="Unknown error occured in registration";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = true;
    $response["error-msg"] = "Required parameters (name, username, email, or password) is missing!";
    echo json_encode($response);
}
?>
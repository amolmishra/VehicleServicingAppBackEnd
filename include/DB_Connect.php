<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16/3/17
 * Time: 11:51 PM
 */
class DB_Connect {
    private $conn;

    //Connecting to database
    public function connect() {
        require_once 'include/config.php';

        //Connecting to mysql database
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        //return database handler
        return $this->conn;
    }
}
?>
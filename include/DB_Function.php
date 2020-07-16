<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16/3/17
 * Time: 11:54 PM
 */

class DB_Functions {
    private $conn;

    //constructor
    function __construct()
    {
        require_once 'DB_Connect.php';
        //connecting to database
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }

    //destructor
    function  __destruct()
    {

    }

    /**
     * Storing new user
     * returns user details
     */

    public function storeUser($name, $username, $email, $password, $latitude, $longitude) {
        $encrypted_password = sha1($password);
        $stmt = $this->conn->prepare("INSERT INTO users (name, username, email, password, lat, lon) Values('$name', '$username', '$email', '$encrypted_password', $latitude, $longitude)");
        $result = $stmt->execute();
        $stmt->close();

        // Check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = '$email'");
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }

    }


    


    /**
     * Get user by email and password
     */

    public function getUserByUsernameAndPassword($username, $password) {
        $encrypted_Password = sha1($password);
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND password = '$encrypted_Password' ");

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return null;
        }
    }

    /**
     * check if user exists or not
     */
    public function isUser($email, $username) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = '$email' OR username = '$username'");
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user exists
            $stmt->close();
            return true;
        } else {
            // user doesn't exist
            $stmt->close();
            return false;
        }
    }
    
    /**
     * Delete history using username and service id
     */
    
    public function deleteHistory($username, $serviceid) {
        $stmt = $this->conn->prepare("DELETE * FROM history WHERE username = '$username' AND serviceid = '$serviceid'");
        $result = $stmt->execute();
        
        if ($result) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
    public function isBooking($username, $registerd_car_id, $date) {
        $stmt = $this->conn->prepare("SELECT * FROM history WHERE username = '$username' AND registered_car_id = '$registerd_car_id' AND date = '$date'");
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            //appointment exists
            $stmt->close();
            return true;
        } else {
            // appointment doesn't exist
            $stmt->close();
            return false;
        }
    }
    
    // Create new user appointment
    public function createAppointment($username, $registered_car_id, $date, $time, $centerid, $pickup, $charges) {
        $stmt = $this->conn->prepare("INSERT INTO history (username, registered_car_id, date, time, centerid, pickup, charges) VALUES('$username', '$registered_car_id', '$date', '$time', '$centerid', '$pickup', '$charges' )");
        $result = $stmt->execute();
        
        if ($result) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
    // Create new user appointment without charges
    public function createAppointmentWithoutCharges($username, $registered_car_id, $date, $time, $centerid, $pickup) {
        $stmt = $this->conn->prepare("INSERT INTO history (username, registered_car_id, date, time, centerid, pickup) VALUES('$username', '$registered_car_id', '$date', '$time', '$centerid', '$pickup')");
        $result = $stmt->execute();

        if ($result) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }        
    }

    // check if a car is already registered
    public function isCar($regno) {
        $stmt = $this->conn->prepare("SELECT * FROM registered_cars WHERE regno = '$regno'");
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // car already registered
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }


    // check if a car is already registered
    public function isServiceCenter($name, $phone, $email) {
        $stmt = $this->conn->prepare("SELECT * FROM service_centers WHERE name = '$name' AND phone = '$phone' AND email = '$email'");
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // service center already registered
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

   
    // register a car
    public function registerCar($name, $model, $regno, $username) {
        $stmt = $this->conn->prepare("INSERT INTO registered_cars (name, model, regno, username) VALUES('$name', '$model', '$regno', '$username')");
        $result = $stmt->execute();
        $stmt->close();

        // Check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM registered_cars WHERE regno = '$regno'");
            $stmt->execute();
            $car = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $car;
        } else
            return false;
    }

    // all appointments
    public function allAppointments($username) {
        $stmt = $this->conn->prepare("SELECT * FROM history WHERE username = '$username'");
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment = array();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
                $appointment[$i] = $row;
            $i++;
        }
        return $appointment;
    }
    
    // all service centers
    public function getAllServiceCenters() {
        $stmt = $this->conn->prepare("SELECT * FROM service_centers");
        $stmt->execute();
        $result = $stmt->get_result();
        $serviceCenters = array();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $serviceCenters[$i] = $row;
            $i++;
        }
        return $serviceCenters;
    }

    // create service center
    public function createServiceCenter($name, $email, $phone, $address, $company, $latitude, $longitude) {
        $stmt = $this->conn->prepare("INSERT INTO service_centers (name, address, phone, company, email, lat, lon) VALUES('$name', '$address', '$phone', '$company', '$email', '$latitude', '$longitude')");
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM service_centers WHERE name = '$name' AND phone = '$phone' AND email = '$email'");
            $stmt->execute();
            $service_center = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $service_center;
        } else
            return false;
    }
    
    // get cars registered
    public function getCars($username) {
        $stmt = $this->conn->prepare("SELECT * FROM registered_cars WHERE username = '$username'");
        $stmt->execute();
        $result = $stmt->get_result();
        $cars = array();
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $cars[$i] = $row;
                $i++;
        }
        return $cars;
    }

    // get service center latitude
    public function getCenterLat($centerid) {
        $stmt = $this->conn->prepare("SELECT * FROM service_centers WHERE id = '$centerid'");
        $stmt->execute();
        $latitude = $stmt->get_result()->fetch_assoc()['lat'];
        $stmt->close();
        return $latitude;
    }

    // get service center longitude
    public function getCenterLong($centerid) {
        $stmt = $this->conn->prepare("SELECT * FROM service_centers WHERE id = '$centerid'");
        $stmt->execute();
        $longitude = $stmt->get_result()->fetch_assoc()['lon'];
        $stmt->close();
        return $longitude;
    }

}
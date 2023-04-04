<?php

class User_controller
{

    public function __construct() {

    }

    private function Connect() {

        $db_username = 'root';
        $db_password = '';
        
        try{

            $conn = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', $db_username, $db_password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "You are connected to the database <br>";
        }

        catch(PDOException $e){

            echo "Error : " . $e->getMessage();

        }
    }

}

?>
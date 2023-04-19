<?php
namespace App\Model;

use DateTime;
use PDO;

class ProfilModel{

    public ?PDO $connect;


    public function __construct()
    {
        try {
            $this->connect = new \PDO('mysql:host=localhost;dbname=boutique_en_ligne', "root", "");
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }


    public function showInfoProfil() :array

    {
        $stmt = $this->connect->prepare('SELECT * FROM user');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateProfil(?string $login,?string $password,?string $email)
    {
        $id = $_SESSION['user']['id'];
        $stmt = $this->connect->prepare('UPDATE user SET login = :login, password = :password, email = :email WHERE id = :id' );
        $stmt->bindParam(':login',$login);
        $stmt->bindParam(':password',$password);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        
    }

    public function insertProfil(?string $firstname,?string $lastname,?string $date,?string $phone){

        $stmt = $this->connect->prepare("INSERT INTO user(firstname,lastname,date,phone) VALUES(:firstname,:lastname,:date,:phone)");
        $stmt->bindParam(':firstname',$firstname);
        $stmt->bindParam(':lastname',$lastname);
        $stmt->bindParam(':date',$date);
        $stmt->bindParam(':phone',$phone);
        $result = $stmt->execute();
        var_dump($result);
        
    }
}

?>
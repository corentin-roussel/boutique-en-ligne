<?php

class AdminModel
{

    private PDO $conn;

    public function __construct() {

        $db_username = 'root';
        $db_password = '';
        
        try{

            $this->conn = new PDO('mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8', $db_username, $db_password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch(PDOException $e){

            echo "Error : " . $e->getMessage();
        }
    }

    public function GetAllRoles() {

        $sql = "SELECT * FROM role";

        $req = $this->conn->prepare($sql);
        $req->execute();
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);

        return $tab;
    }

    public function GetUserDataByRoleId($idRole) {

        if($idRole == 'all') {

            $sql = "SELECT *,user.id FROM user INNER JOIN role ON user.id_role = role.id";

            $req = $this->conn->prepare($sql);
            $req->execute();
            $tab = $req->fetchAll(PDO::FETCH_ASSOC);

        }else{

            $sql = "SELECT *,user.id FROM user INNER JOIN role ON user.id_role = role.id WHERE id_role = :idRole";
            
            $req = $this->conn->prepare($sql);
            $req->execute(array(':idRole' => $idRole));
            $tab = $req->fetchAll(PDO::FETCH_ASSOC);
        }

        return $tab;

    }

    public function GetAllRoleExeptActualById($idActualRole) {

        $sql = "SELECT * FROM role WHERE NOT id = :actualId";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':actualId' => $idActualRole));
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);

        return $tab;

    }

}
<?php

namespace App\Model;
use PDO;
class AdminModel {

    private  $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=boutique_en_ligne', "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function reqInsertGame ($title, $desc, $price, $image, $date, $developper, $publisher, $category, $sub_category)
    {
        $req = $this->conn->prepare("INSERT INTO product (title, description, price, image, release_date, developper, publisher, id_category, id_subcategory) VALUES (:title, :description, :price, :image, :release_date, :developper, :publisher, :id_category, :id_subcategory)");
        $req->execute(array(
            ":title" => $title,
            ":description" => $desc,
            ":price" => $price,
            ":image" => $image,
            ":release_date" => $date,
            ":developper" => $developper,
            ":publisher" => $publisher,
            ":id_category" => $category,
            ":id_subcategory" => $sub_category
        ));
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

    public function UpdateRole($idRole, $idUser) {

        $sql = "UPDATE user SET id_role = :id_role WHERE id = :userId";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':id_role' => $idRole,
                            ':userId' => $idUser
        ));
        
        return "Role changed successfully";

    }

    public function DeleteUser($idUser) {

        $sql = "DELETE FROM user WHERE id = :idUser";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':idUser' => $idUser));

        return "User deleted successfully";

    }

}
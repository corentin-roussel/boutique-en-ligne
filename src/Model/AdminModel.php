<?php

namespace App\Model;
use PDO;
class AdminModel {

    public ?PDO $conn;

    public function __construct()
    {
        try {
            $this->conn = new \PDO('mysql:host=localhost;dbname=boutique_en_ligne', "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
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


    public function getPlatform() {
        $req = $this->conn->prepare("SELECT * FROM platform");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertPlatform($id_game, $id_platform) {
        $req = $this->conn->prepare("INSERT INTO compatibility (id_game, id_platform) VALUES (:id_game, :id_platform)");
        $req->execute(array(
            ":id_game" => $id_game,
            ":id_platform" => $id_platform
        ));

    }


    public function fetchLastGame() {
        $req = $this->conn->prepare("SELECT product.id FROM product ORDER BY id DESC LIMIT 1");
        $req->execute();
        $lastGame = $req->fetch(PDO::FETCH_ASSOC);

        var_dump($lastGame);

        return $lastGame;
    }

    public function selectGames()
    {

        $req = $this->conn->prepare("SELECT * FROM product");
        $req->execute();
        $allGame = $req->fetchAll(PDO::FETCH_ASSOC);


        foreach ($allGame as $key => $game ){

            $platform = $this->conn->prepare("SELECT id_game, platform.platform FROM compatibility
                                            INNER JOIN platform ON platform.id = compatibility.id_platform
                                            WHERE :id_game = id_game");
            $platform->execute(array(
                ":id_game" => $game['id']
            ));
            $platforms  = $platform->fetchAll(PDO::FETCH_ASSOC);
            $game['platforms'] = $platforms;
            $allGame[$key] = $game;
        }

        echo json_encode($allGame, JSON_PRETTY_PRINT);
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
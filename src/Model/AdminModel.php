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
}
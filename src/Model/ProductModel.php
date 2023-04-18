<?php

namespace App\Model;
use PDO;

class ProductModel {

    private $conn;

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

    public function GetAllOneTable($table) {

        $sql = "SELECT * FROM " . $table;

        $req = $this->conn->prepare($sql);
        $req->execute();
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);

        return $tab;
    }

    public function GetProductByFilter($platform, $category, $subcategory) {

        $sqlParam = [];

        $platform === 'all' ? ($sqlPlat1 = "") . ($sqlPlat2 = "") : ($sqlPlat1 = " INNER JOIN compatibility ON product.id = compatibility.id_game INNER JOIN platform ON compatibility.id_platform = platform.id") . ($sqlPlat2 = " AND id_platform = :platform") . ($sqlParam[':platform'] = $platform);
        $category === 'all' ? $sqlCat = "" : ($sqlCat = " WHERE id_category = :category") . ($sqlParam[':category'] = $category);
        $subcategory === 'all' ? $sqlSubcat = "" : ($sqlSubcat = " AND id_subcategory = :subcategory") . ($sqlParam[':subcategory'] = $subcategory);

        $sql = "SELECT *,product.id FROM product" . $sqlPlat1 . $sqlCat . $sqlSubcat . $sqlPlat2;
        $req = $this->conn->prepare($sql);
        $req->execute($sqlParam);

        $tab = $req->fetchAll(PDO::FETCH_ASSOC);

        return $tab;

    }

    public function GetDataOneProduct($id) {

        $sql = "SELECT *,product.id, SUBSTRING(description, 1,200) AS 'short_description' FROM product INNER JOIN category ON product.id_category = category.id INNER JOIN subcategory ON product.id_subcategory = subcategory.id WHERE product.id = :id";
        $req = $this->conn->prepare($sql);
        $req->execute([':id' => $id]);

        $tab = $req->fetchAll(PDO::FETCH_ASSOC);

        return $tab;

    }

}

?>
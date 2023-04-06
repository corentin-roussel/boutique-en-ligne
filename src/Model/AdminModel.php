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

}
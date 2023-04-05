<?php

namespace model;
class AdminModel {

    private  $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=boutique-en-ligne', "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function reqInsertGame ($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category)
    {
        $req = $this->conn->prepare("INSERT INTO product (title, description, price, image, release_date, developper, publisher, id_category, id_subcategory) VALUES (:title, :description, :price, :image, :release_date, :developper, :publisher, :id_category, :id_subcategory)");
        $req->execute(array(
            ":title" => $title,
            ":description" => $desc,
            ":price" => $price,
            ":image" => $image,
            ":date" => $date,
            ":publisher" => $publisher,
            ":developper" => $developper,
            ":id_category" => $category,
            ":id_subcategory" => $sub_category
        ));
    }

}
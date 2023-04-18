<?php

namespace App\Model;
use PDO;

class CartModel 
{

    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=boutique_en_ligne', "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function AddProduct($idProduct, $quantity, $platform, $cartId) {

        $message = [];

        $sqlCount = "SELECT * FROM item_cart WHERE id_cart = :cart AND id_game = :idProduct AND platform = :platform";
        
        $reqCount = $this->conn->prepare($sqlCount);
        $reqCount->execute([':cart' => $cartId,
                            ':idProduct' => $idProduct,
                            ':platform' => $platform
        ]);
        $row = $reqCount->rowCount();

        if($row === 0) {

            $sql = "INSERT INTO item_cart (id_cart, id_game, quantity, platform) VALUES (:cart, :idProduct, :quantity, :platform)";
            $req = $this->conn->prepare($sql);
            $req->execute([':cart' => $cartId,
                           ':idProduct' => $idProduct,
                           ':quantity' => $quantity,
                           ':platform' => $platform
            ]);

            $message = "The article was successfully added to the cart";

        }else{

            $sqlId = "SELECT quantity, id FROM item_cart WHERE id_cart = :cart AND id_game = :idProduct AND platform = :platform";
            
            $reqId = $this->conn->prepare($sqlId);
            $reqId->execute([':cart' => $cartId,
                             ':idProduct' => $idProduct,
                             ':platform' => $platform
            ]);

            $tab = $reqId->fetch(PDO::FETCH_ASSOC);

            $quantityNew = $tab['quantity'] + $quantity;

            $sqlUp = "UPDATE item_cart SET quantity = :quantity WHERE id = :id";

            $reqUp = $this->conn->prepare($sqlUp);
            $reqUp->execute([':quantity' => $quantityNew,
                             ':id' => $tab['id']
            ]);

            $message = "The article was successfully added to the cart";
        }

        return $message;

    }

}

?>
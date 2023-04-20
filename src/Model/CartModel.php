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

    public function GetCartContent($cart) {

        $sql = "SELECT *, item_cart.id, product.price AS game_price, item_cart.price AS price FROM item_cart INNER JOIN cart ON item_cart.id_cart = cart.id INNER JOIN product ON item_cart.id_game = product.id WHERE id_cart = :idCart";

        $req = $this->conn->prepare($sql);
        $req->execute([':idCart' => $cart]);
        $cartContent = $req->fetchAll(PDO::FETCH_ASSOC);

        return $cartContent;

    }

    public function DeleteItemOneLine($idItemLine) {

        $sqlGetPrice = "SELECT price FROM item_cart WHERE id = :id";
        $reqGetPrice = $this->conn->prepare($sqlGetPrice);
        $reqGetPrice->execute([':id' => $idItemLine]);

        $priceOneLine = $reqGetPrice->fetch(PDO::FETCH_ASSOC);


        $sqlGetPriceCart = "SELECT total_price , cart.id AS cartId FROM item_cart INNER JOIN cart ON item_cart.id_cart = cart.id WHERE item_cart.id = :id";
        $reqGetPriceCart = $this->conn->prepare($sqlGetPriceCart);
        $reqGetPriceCart->execute([':id' => $idItemLine]);

        $priceOneCart = $reqGetPriceCart->fetch(PDO::FETCH_ASSOC);
        

        $newCartPrice = $priceOneCart['total_price'] - $priceOneLine['price'];
        $cartId = $priceOneCart['cartId'];;

        $sqlChangeCartPrice = "UPDATE cart SET total_price = :newPrice WHERE id = :cartId";
        $reqChangeCartPrice = $this->conn->prepare($sqlChangeCartPrice);
        $reqChangeCartPrice->execute([':newPrice' => $newCartPrice,
                                      ':cartId' => $cartId
        ]);


        $sqlDelete = "DELETE FROM item_cart WHERE id = :id";

        $reqDelete = $this->conn->prepare($sqlDelete);
        $reqDelete->execute([':id' => $idItemLine]);

        $message = "The item was successfully deleted from your cart";

        return $message;

    }

    public function ChangeQuantity($quantity, $itemId) {

        $sqlGetPriceLine = "SELECT price FROM item_cart WHERE id = :id";
        $reqGetPriceLine = $this->conn->prepare($sqlGetPriceLine);
        $reqGetPriceLine->execute([':id' => $itemId]);

        $priceOneLine = $reqGetPriceLine->fetch(PDO::FETCH_ASSOC);


        $sqlGetPrice = "SELECT product.price FROM item_cart INNER JOIN product ON item_cart.id_game = product.id WHERE item_cart.id = :id";
        $reqGetPrice = $this->conn->prepare($sqlGetPrice);
        $reqGetPrice->execute([':id' => $itemId]);

        $priceOneItem = $reqGetPrice->fetch(PDO::FETCH_ASSOC);


        $sqlGetPriceCart = "SELECT total_price , cart.id AS cartId FROM item_cart INNER JOIN cart ON item_cart.id_cart = cart.id WHERE item_cart.id = :id";
        $reqGetPriceCart = $this->conn->prepare($sqlGetPriceCart);
        $reqGetPriceCart->execute([':id' => $itemId]);

        $priceOneCart = $reqGetPriceCart->fetch(PDO::FETCH_ASSOC);


        // !!!!!!! IF MOINS !!!!!!! //
        

        $newCartPrice = $priceOneCart['total_price'] - $priceOneItem['price'];
        $cartId = $priceOneCart['cartId'];;

        $sqlChangeCartPrice = "UPDATE cart SET total_price = :newPrice WHERE id = :cartId";
        $reqChangeCartPrice = $this->conn->prepare($sqlChangeCartPrice);
        $reqChangeCartPrice->execute([':newPrice' => $newCartPrice,
                                      ':cartId' => $cartId
        ]);


        $changePrice = $priceOneLine['price'] - $priceOneItem['price'];

        $sql = "UPDATE item_cart SET quantity = :quantity, price = :price WHERE id = :id";
        $req = $this->conn->prepare($sql);
        $req->execute([':quantity' => $quantity,
                       ':price' => $changePrice,
                       ':id' => $itemId
        ]);

        return $changePrice;

    }

}

?>
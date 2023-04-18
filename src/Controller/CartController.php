<?php

namespace App\Controller;

use App\Model\CartModel;

class CartController
{

    private $model;

    public function __construct() {

        $this->model = new CartModel();

    }

    public function AddProduct($id, $quantity, $platformId) {

        if($quantity < 1 && $quantity > 50) {

            $message = $this->model->AddProduct($id, $quantity, $platformId);

            return $message;

        }

    }

}

?>
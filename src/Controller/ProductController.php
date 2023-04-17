<?php

namespace App\Controller;

use App\Model\ProductModel;

class ProductController {

    private $model;

    public function __construct() {

        $this->model = new ProductModel();
        
    }

    public function GetAllOneTable($table) {

        $result = $this->model->GetAllOneTable($table);

        return $result;

    }

    public function GetProductByFilter($platform, $category, $subcategory) {

        $products = $this->model->GetProductByFilter($platform, $category, $subcategory);
        
        return $products;

    }

}

?>
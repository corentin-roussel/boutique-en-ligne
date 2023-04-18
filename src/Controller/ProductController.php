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

    public function getPreorderGame():array
    {
        return $this->model->preorderGames();
    }

    public function getRandGames():array
    {
        foreach($this->model->randomGames() as $key => $games)
        {
            $game[] = '<div class="new-released-game">
                        <a href="game.php?id='. $games['id'] .'"><img src="'. $games['image'] .'" class="img-rand-games" alt="" /></a>
                        <div class="new-rand-games-title-price">
                            <a href="game.php?id=' . $games['id'] . '">' . $games['title'] . '</a>
                            <p>' . $games['price'] . '</p>
                        </div>
                    </div>';
        }
        return $game;
    }

    public function getNewReleasedGames():array
    {


        foreach($this->model->newReleasedGames() as $key => $games)
        {
            $game_price = substr_replace($games['price'], ".", -2, 0) . "€";
            $game[] = '<div class="new-released-game">
                        <a href="game.php?id='. $games['id'] .'" class="link-games" ><img src="'. $games['image'] .'" class="img-released-games" alt=""/></a>
                        <div class="new-released-games-title-price">
                            <a href="game.php?id=' . $games['id'] . '" class="new-released-text">' . $games['title'] . '</a>
                            <p class="new-released-price">' . $game_price . '</p>
                        </div>
                    </div>';
        }
        return $game;
    }

}

?>
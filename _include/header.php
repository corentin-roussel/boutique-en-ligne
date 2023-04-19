<?php

    require_once (__DIR__ . "/../autoloader.php");

    use App\Controller\ProductController;
    $product = new ProductController();

    if(isset($_GET['getAll'])) {
        
        $searchResult = $product->GetAllByLetters($_GET['search']);

        if(isset($searchResult[0]) && $searchResult[0] != "") {    
            
            $pages = [];
            
            $numPage = 0;

            for ($i=0; $i < sizeof($searchResult); $i+=6) {

                $numPage++;

                for ($j=$i; $j < $i+6; $j++) {
                    
                    if(isset($searchResult[$j])) {

                        $pages[$numPage][$j] =
                        '<div class="oneGame">
                            <a href="product.php?id=' . $searchResult[$j]['id'] . '"><img src="' . $searchResult[$j]['image'] . '" alt="" /></a>
                            <div class="titrePrix">
                                <a href="product.php?id=' . $searchResult[$j]['id'] . '">' . $searchResult[$j]['title'] . '</a>
                                <a href="product.php?id=' . $searchResult[$j]['id'] . '"><p>' . substr_replace($searchResult[$j]['price'], '.', -2, 0) . '€' . '</p></a>
                            </div>
                        </div>';
                    }
                }

                $pages['numPage'][$numPage] = '<p class="changePageSearch" id="page' . $numPage . '">' . $numPage  ;
            }
        }else{
            $pages['noResult'] = "There is no product that match your search";
        }

        $json = json_encode($pages, JSON_PRETTY_PRINT);
        echo $json;

        die();

    }

?>
<a href="index.php">Home</a>
<?php if(!isset($_SESSION['user'])) : ?> <a href="authentification.php">Authenticate</a> <?php endif ?>
<?php if(isset($_SESSION['user'])) : ?> <a href="profile.php">Profile</a> <?php endif ?>
<a href="all_products.php">All products</a>
<a href="platform.php">Platform</a>
<?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') : ?> <a href="admin.php">Admin</a> <?php endif ?>

<input type="text" name="searchBar" id="searchBar">
<i class="fa-solid fa-magnifying-glass" id="iconSearch"></i>
>>>>>>> main

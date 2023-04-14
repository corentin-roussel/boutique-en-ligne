<?php

    if(session_status() == PHP_SESSION_NONE){ session_start();}

    require_once ("autoloader.php");

    use App\Controller\ProductController;
    $product = new ProductController();

    function createOptionsSelect($table) {
    
        $product = new ProductController();

        $resultTab = $product->GetAllOneTable($table);

        foreach ($resultTab as $result) : ?>

            <option value="<?= $result['id'] ?>"><?= $result[$table] ?></option>
            
        <?php endforeach;

    }

    if(isset($_GET['games']) || isset($_GET['pagination'])) {

        $productsTable = $product->GetProductByFilter($_GET['platform'], $_GET['category'], $_GET['subcategory']);

        $pages = [];
        
        $numPage = 1;

        for ($i=0; $i < sizeof($productsTable); $i+=15) {

            for ($j=$i; $j < $i+15; $j++) {
                
                if(isset($productsTable[$j])) {
                    $productsTable[$j]['price'] = substr_replace($productsTable[$j]['price'], ".", -2, 0) . "€";
                    $pages[$numPage][$j] =
                    '<div class="oneGame">
                        <img src="' . $productsTable[$j]['image'] . '" alt="" />
                        <div class="titrePrix">
                            <a href="game.php?id=' . $productsTable[$j]['id'] . '">' . $productsTable[$j]['title'] . '</a>
                            <p>' . $productsTable[$j]['price'] . '</p>
                        </div>
                    </div>';
                }
            }

            $pages['numPage'][$numPage] = '<p class="changePage" id="page' . $numPage . '">' . $numPage . '</p>';

            $numPage++;
        }

        $json = json_encode($pages, JSON_PRETTY_PRINT);
        echo $json;

        die();
    }

?>


<!doctype html>
<html lang="en">
<head>
   <?php require_once("_include/head.php") ?>
    <script src="https://kit.fontawesome.com/1241fb6252.js" crossorigin="anonymous"></script>
    <script defer src="all_products.js"></script>
    <title>All products</title>
</head>
<body>
    <header>
        <?php require_once "_include/header.php" ?>
    </header>

    <main>

        <div class="filters">

            <select name="platform" id="selectPlatform">
                <option value="all">Platform</option>
                <?= createOptionsSelect('platform') ?>
            </select>

            <select name="category" id="selectCategory">
                <option value="all">Category</option>
                <?= createOptionsSelect('category') ?>
            </select>

            <select name="subcat" id="selectSubcat">
                <option value="all">Sub category</option>
                <?= createOptionsSelect('subcategory') ?>
            </select>

        </div>

        <div id="displayArticles"></div>

        <div id="displayPagination"></div>

    </main>

    <footer>
        <?php require_once "_include/footer.php" ?>
    </footer>
</body>
</html>
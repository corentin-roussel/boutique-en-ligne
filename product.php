<?php

    if(session_status() == PHP_SESSION_NONE){ session_start();}

    require_once ("autoloader.php");

    use App\Controller\ProductController;
    $product = new ProductController();

    function createOptionsSelect($table) {
    
        $product = new ProductController();

        $resultTab = $product->GetAllOneTable($table);

        $resultat = "";

        foreach ($resultTab as $result) {

            $resultat = $resultat . '<option value="' . $result[$table] . '">' . $result[$table] . '</option>'; 

        }

        return $resultat;
    }

    if(isset($_GET['getDataProduct'])) :

        $data = $product->GetDataOneProduct($_GET['getDataProduct']);

        $data[0]['price'] = substr_replace($data[0]['price'], ".", -2, 0) . "€";
        
        $displayProduct = [];
        
        $options = createOptionsSelect('platform');
        
        $displayProduct['part1'] = '
        <img src="' . $data[0]['image'] . '" alt="" id="productImage" />

        <div id="divDroite">

            <div id="titreShortDescrPrix">

                <div id="titreShortDescr">

                    <h2>' . $data[0]['title'] . '</h2>

                    <p>' . $data[0]['short_description'] . '...</p>

                    <a href="#decriptionProduct">Read more</a>

                </div>

                <p>' . $data[0]['price'] . '</p>

            </div>

            <div id="selectsButton">

                <select name="platform" id="selectPlatform">
                    <option value="">Platform</option>'
                    . $options .
                '</select>

                <span>
                    <p>Quantity</p>

                    <span id="quantityChoice">
                        <i class="fa-solid fa-circle-minus" id="quantiteMoins"></i>
                        <p id="quantiteNum">1</p>
                        <i class="fa-solid fa-circle-plus" id="quantitePlus"></i>
                    </span>
                </span>

                <button id="cartButton"><i class="fa-solid fa-cart-plus"></i></button>
                <div id="cartMessage></div>
            </div>
        </div>';

        $displayProduct['part2'] = '
        <div id="divDescriptionAbout">

            <div id="titresDescriptionAbout">
                <span id="titreDescription"><h3>Description</h3></span>
                <span id="titreAbout"><h3>About the game</h3></span>
            </div>

            <div id="paraDescription" style="display: block;">
                <p>' . $data[0]['description'] . '</p>
            </div>

            <div id="paraAbout" style="display: none;">
                <p>Developper : ' . $data[0]['developper'] . '</p>
                <p>Publisher : ' . $data[0]['publisher'] . '</p>
                <p>Release date : ' . $data[0]['release_date'] . '</p>
                <p>Categories : ' . $data[0]['category'] . ', ' . $data[0]['subcategory'] . '</p>
            </div>
        </div>';

        $json = json_encode($displayProduct, JSON_PRETTY_PRINT);
        echo $json;

        die();

    endif;

    use App\Controller\CartController;
    $cart = new CartController;

    !isset($_GET['addToCart']) ?: ($message = $cart->AddProduct($_GET['addToCart'], $_GET['quantity'], $_GET['platformId'], $_SESSION['user']['actualCart'])) .(die());

?>

<!doctype html>
<html lang="en">
<head>
   <?php require_once("_include/head.php") ?>
    <script src="https://kit.fontawesome.com/1241fb6252.js" crossorigin="anonymous"></script>
    <script defer src="product.js"></script>
    <title>Products</title>
</head>
<body>
    <header>
        <?php require_once "_include/header.php" ?>
    </header>

    <main>
        <div id="displayImageTextSelect"></div>
        <div id="displayDescriptionAbout"></div>
    </main>

    <footer>
        <?php require_once "_include/footer.php" ?>
    </footer>
</body>
</html>
<?php

require_once("autoloader.php");

use App\Controller\PlateformController;
use App\Controller\AdminControllerGame;
use App\Controller\CategoryController;
// use App\model\PlateformModel;

$controlPlat = new PlateformController();
$AdminController = new AdminControllerGame();
$categoryController = new CategoryController();



if (isset($_POST['content'])) {
    $controlPlat->addForm($_POST['content']);
    die();
}

if(isset($_GET['addCat'])){
    $categoryController->addCat($_POST['content_cat']);
    die();
}

if(isset($_GET['addSub'])){
    $categoryController->addSubCat($_POST['content_sub_cat']);
    die();
}








if (isset($_GET['submitGame'])) {
    $AdminController->insertGame($_POST["title"], $_POST["desc"], $_POST["price"], $_POST["image"], $_POST["release_date"], $_POST["developper"], $_POST["publisher"], $_POST["category"], $_POST["subcategory"]);
}


?>


<!DOCTYPE html>
<html lang="Fr">

<head>
    <?php require_once("_include/head.php") ?>
    <title>Game Vault - Boutique en ligne</title>
</head>

<body>

    <?php require_once('./_include/header.php'); ?>

    <div class="container-dash-admin">
        <h2>Dashboard Admin</h2>
    </div>

    <div class="container-user-man">
        <h3>User Manager</h3>
    </div>


    <div class="container-pro-stock">
        <h3>Product & Stock management</h3>
    </div>

    <!-- CONTAINER ADD PLATFORM -->

    <div class="container-title">
        <h4>Plateform</h4>
    </div>

    <div class="container-btn-plateforme">
        
        <button type="button" id="add_plat">Add Plateform</button>
        
    </div>
    
    <div class="form-add-plateform">
        <form action="" method="POST" id="form-insert-plateform">
                <label for="plateform"></label>
                <input type="text" name="content" id="content" placeholder="Write a plateform">
                <button type="submit" name="submit_form" value="submit_form">ADD</button>  
        </form>
    </div>

    <div class="container-mess-plateform">

    </div>

    <div class="container-table-plat">

     
    </div>
    <!-- CONTAINER ADD CATEGORY -->

    <div class="container-title">
        <h4>Category</h4>
    </div>


    <div class="container-btn-category">
        <button type="button" id="add_category">Add Category</button>
    </div>

    <div class="form-add-category">
        

    </div>

    <div class="container-mess-cat" style="text-align:center;">

    </div>

    <div class="container-sub-form">

    </div>

    <div class="container-table-cat">

    </div>

    <!-- CONTAINER ADD GAME -->
    <main>
        <button class="button" id="addFormGame">Add Game</button>

        <div id="placeAddGame">

        </div>
    </main>
    <!-- FOOTER -->
    <footer>

    </footer>
</body>

</html>
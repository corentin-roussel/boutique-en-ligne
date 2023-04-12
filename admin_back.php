<?php
require_once ("autoloader.php");

use App\Controller\AdminControllerGame;
use App\Model\AdminModel;


$AdminController = new  AdminControllerGame();
$adminShowGame = new AdminModel();

$adminShowGame->fetchLastGame();

$getPlatform = $adminShowGame->getPlatform();


if(isset($_GET['formAddGame'])):
?>

<form id="formGame" method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
    <div id="error-field"></div>

    <label for="desc">Description</label>
    <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
    <div id="error-desc"></div>

    <label for="price">Price</label>
    <input type="number" id="price" name="price">
    <div id="error-price"></div>

    <label for="image">Image</label>
    <input type="text" name="image" id="image">

    <label for="release_date">Release date</label>
    <input type="date" name="release_date" id="release_date">

    <label for="developper">Developper</label>
    <input type="text" name="developper" id="developper">

    <label for="publisher">Publisher</label>
    <input type="text" name="publisher" id="publisher">

    <?php foreach ($getPlatform as $key => $platform){ ; ?>
        <label for="platform"><?php echo $platform['platform'] ?></label>
        <input type="checkbox" name="check_list[]" class="platform" value="<?php echo $platform['id'] ?>">
    <?php }    ?>

    <label for="category">Category</label>
    <select name="category" id="category">
        <option value="1">Action</option>
    </select>

    <label for="subcategory">Sub-scategory</label>
    <select name="subcategory" id="subcategory">
        <option value="2">Aventure</option>
    </select>

    <input type="submit" id="submitGame" name="submitGame">
</form>
<?php
    die(); endif
?>
<?php


    !isset($_GET['submitGame']) ?: $AdminController->insertGame($_POST["title"], $_POST["desc"], $_POST["price"], $_POST["image"], $_POST["release_date"], $_POST["developper"], $_POST["publisher"], $_POST['check_list'], $_POST["category"], $_POST["subcategory"]);var_dump($_POST);


    !isset($_GET['showGame']) ?: $adminShowGame->selectGames();




?>
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("autoloader.php");
// require_once("autoloader.php");

use App\Controller\PlateformController;
use App\Controller\AdminControllerGame;
use App\Controller\CategoryController;
use App\Controller\AdminControllerUser;

$adminUser = new AdminControllerUser();
$controlPlat = new PlateformController();
$AdminController = new AdminControllerGame();
$categoryController = new CategoryController();



if (isset($_POST['content'])) {
    $controlPlat->addForm($_POST['content']);
    die();
}

if (isset($_GET['addCat'])) {
    $categoryController->addCat($_POST['content_cat']);
    die();
}

if (isset($_GET['addSub'])) {
    $categoryController->addSubCat($_POST['content_sub_cat']);
    die();
}



if (isset($_GET['submitGame'])) {
    $AdminController->insertGame($_POST["title"], $_POST["desc"], $_POST["price"], $_POST["image"], $_POST["release_date"], $_POST["developper"], $_POST["publisher"],$_POST['check_list'] , $_POST["category"], $_POST["subcategory"]);
}



!isset($_GET['getAllRoles']) ?: ($adminUser->GetAllRoles()) . (die());

!isset($_GET['actualRole']) ?: ($adminUser->GetAllRoleExeptActual($_GET['actualRole'])) . (die());

!isset($_GET['inputRole']) ?: ($adminUser->GetUsersDataByRole($_GET['inputRole'])) . (die());

if (isset($_GET['tableUserRole'])) : $dataUsers = $adminUser->GetUsersDataByRole($_GET['tableUserRole']);

?>



    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>LOGIN</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dataUsers as $user) : ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['login'] ?></td>
                    <td>
                        <select name="<?= $user['id'] ?>" id="changeRoleUser<?= $user['id'] ?>" class="selectChangeRole">
                            <option value="<?= $user['id'] ?>"><?= $user['role'] ?></option>
                            <?php $otherRoles = $adminUser->GetAllRoleExeptActual($user['id_role']) ?>
                            <?php foreach ($otherRoles as $role) : ?>
                                <option value="<?= $role['id'] ?>"><?= $role['role'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td><button class="infoUser" value="<?= $user['id'] ?>">INFOS</button></td>
                    <td><button class="supprUser" value="<?= $user['id'] ?>">DELETE</button></td>
                </tr>

                <tr id="infosUser<?= $user['id'] ?>" style="display: none;">
                    <td colspan="5">
                        <p>email : <?= $user['email'] ?></p>
                        <p>first name : <?= $user['firstname'] ?></p>
                        <p>last name : <?= $user['lastname'] ?></p>
                        <p>birth date : <?= $user['birth_date'] ?></p>
                        <p>phone number : <?= $user['phone_number'] ?></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

<?php die();
endif;

!isset($_GET['changeRole']) ?: ($adminUser->ChangeUserRole($_GET['changeRole'], $_GET['userId'])) . (die());

!isset($_GET['deleteUser']) ?: ($adminUser->DeleteUser($_GET['deleteUser'])) . (die());

if (isset($_SESSION) && $_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'moderator') :


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php require_once("_include/head.php") ?>
        <script defer src="admin_game.js"></script>
        <script defer src="admin_user.js"></script>
        <title>Admin</title>
    </head>

    <body>
        <header>

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

                    <button type="button" id="add_plat">Plateform</button>

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
                    <button type="button" id="add_category">Category</button>
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

                    <h2>User manager</h2>

                    <select name="roles" id="role">
                        <option value="all">-- Choose a role --</option>
                    </select>

                    <div id="displayUserData"></div>



                    <h2>Game manager</h2>

                    <button class="button" id="addFormGame">Add Game</button>

                    <div id="placeAddGame">

                    </div>

                    <button class="button" id="showGames">Show Games</button>

                    <div id="placeShowGames">

                    </div>
                </main>
                <!-- FOOTER -->
                <footer>

                </footer>
            </body>

            </html>
        <?php else : header("location: forbidden.php");
    endif; ?>
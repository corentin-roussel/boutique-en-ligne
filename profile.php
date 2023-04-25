<?php


(session_start() == PHP_SESSION_NONE) ?: session_start();
// var_dump($_SESSION);

require_once('autoloader.php');

use App\Controller\ProfilController;

$updateProfil = new ProfilController();

if(isset($_GET['other'])){
    $updateProfil->updateInfoProfil($_POST['login'],$_POST['new_pass'],$_POST['conf_pass'],$_POST['email'],$_POST['firstname'],$_POST['lastname'],$_POST['date'],$_POST['phone']);
    die();
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require_once("_include/head.php") ?>
    <script defer src="./scripts/profile.js"></script>
    <link rel="stylesheet" href="./assets/Profil_style.css">
    <title>GameVault - Profile</title>
</head>

<body>

    <?php require_once('_include/header.php') ?>

    <main>
        <div class="container-title">
            <h1>Profil</h1>
        </div>


        <div class="container-profil">
            <div class="container-profil-left">
            </div>
            <div class="container-profil-right">
            </div>
        </div>
    </main>
    
    <?php require_once('_include/footer.php') ?>

</body>

</html>
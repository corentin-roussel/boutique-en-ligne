<?php 
require_once('autoloader.php');
(session_start() == PHP_SESSION_NONE) ?: session_start();


use App\Controller\ProfilController;
$showInfoUser = new ProfilController();
$getData = $showInfoUser->showInfosProfil();

// var_dump($_GET);
var_dump($_POST);
?>


<form action="" method="POST" id="form_profil">
    <label for="login"></label>
    <input type="text" name="login" id="login_profil" placeholder="<?= $_SESSION['user']['login']?>">
    <label for="password"></label>
    <input type="password" name="new_pass" placeholder="New-password" >
    <label for="conf_pass"></label>
    <input type="password" name="conf_pass" placeholder="Confirmation password" >
    <label for="email"></label>
    <input type="text " name="email" placeholder="<?= $_SESSION['user']['email']?>" >
    <label for="firstname"></label>
    <input type="text" name="firstname" placeholder="FirstName" >
    <label for="lastname"></label>
    <input type="text" name="lastname" placeholder="LastName" >
    <label for="birthday"></label>
    <input type="date" name="date">
    <label for="phone"></label>
    <input type="text" name="phone" placeholder="Phone Number" >
    <button type="subit" name="submit_form_profil">Submit</button>
</form>


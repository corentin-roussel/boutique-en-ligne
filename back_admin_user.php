<?php
    
    if(session_status() == PHP_SESSION_NONE){ session_start();}
    
    require_once 'controller/AdminController.php';
    $admin = new AdminController();

?>

<?php

    !isset($_GET['roles']) ?: $admin->GetAllRoles();

    !isset($_GET['actualRole']) ?: $admin->GetAllRoleExeptActual($_GET['actualRole']);

    !isset($_GET['inputRole']) ?: $admin->GetUsersDataByRole($_GET['inputRole']);

?>
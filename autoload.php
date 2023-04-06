<?php

spl_autoload_register(function($classname){
    //$classname = controller\AdminController
    //require = ./controller/AdminController
    $classname = str_replace("\\",'/',$classname);
    require_once("$classname.php");
    var_dump($classname);
})

?>
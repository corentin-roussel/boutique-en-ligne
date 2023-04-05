<?php

spl_autoload_register("my_autoloader");

function my_autoloader($class, $directory)
{
    $class_path = str_replace("\\", "/", $class);
    $directory_path = str_replace("\\", "/", $directory);

    $file = __DIR__ . '/src/'. $directory_path . "/" . $class_path . ".php";

    if(file_exists($file))
    {
        require_once $file;
    }
}
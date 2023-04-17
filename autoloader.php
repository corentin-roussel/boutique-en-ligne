<?php



function my_autoloader($class)
{

    $class_path = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $class_path = str_replace("App", "src", $class_path);
    $file = __DIR__ . DIRECTORY_SEPARATOR . $class_path . ".php";


    if(file_exists($file))
    {
        require_once $file;
    }
}

spl_autoload_register("my_autoloader");
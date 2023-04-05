<?php

namespace controller;

use model\AdminModel;

class AdminController {
    private ?int $id;

    private ?string $name;

    private ?string $desc;

    private ?int $price;

    private ?string $image;

    private ?string $date;

    private ?string $publisher;

    private ?string $developper;

    private ?int $category;

    private ?int $sub_category;


    public function insertGame($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category)
    {

        function mempty($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category)
        {
            foreach(func_get_args() as $values)
            {
                $values = htmlspecialchars(trim($values));

                if(!empty($values))
                {
                    continue;
                }else
                {
                    return false;
                }
            }
            return true;
        }


        //$checkEmpty = array($name, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category);

        if(preg_match("^[0-9]*$" , $price) && grapheme_strlen($desc) > 100 && mempty())
        {
            $AdminModel = new AdminModel();
            $AdminModel->reqInsertGame($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category);
        }
        else{
            echo"marche po";
        }
    }
}
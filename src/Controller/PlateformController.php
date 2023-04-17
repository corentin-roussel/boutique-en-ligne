<?php

namespace App\Controller;

use App\model\PlateformModel;


class PlateformController
{




    public function __construct()
    {
        //empty

    }

    public function addForm(string $content) :void
    {
        $content = htmlspecialchars(trim($content));
        $messages = [];
        $model = new PlateformModel();

        if (empty($content)) {
            $messages['check_empty'] = "This input is empty";
        } else {

            $model->insertPlateform($content);
            $messages['not_empty'] = "New Category Added ";
        }

        $json_mess = json_encode($messages, JSON_PRETTY_PRINT);

        echo $json_mess;
    }




    public function deletePlat(array $idArrayCheck)
    {
        $model = new PlateformModel();
        
        foreach($idArrayCheck as $key => $platforme){
            $intPlatform = (int)$platforme;
            $model->deletePlateform($intPlatform);
        }

    }
}

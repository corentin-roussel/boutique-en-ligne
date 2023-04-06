<?php

namespace App\controllers;

use App\model\PlateformModel;

require_once('./src/model/Model.php');
require_once('./src/model/PlateformModel.php');



Class AdminPlateform{

    

    
    public function __construct()
    {
       //empty

    }

    public static function addForm($content){
            $content = htmlspecialchars(trim($content));
            $messages = [];
            $model = new PlateformModel();

            if(empty($content)){
                $messages['check_empty'] = "This input is empty";
            }else{

                  $model->insertPlateform($content);
                  $messages['not_empty'] = "New Category Added ";
            }
            
            $json_mess = json_encode($messages,JSON_PRETTY_PRINT);
            
            echo $json_mess;
            
    }

    
}

?>
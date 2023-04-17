<?php

namespace App\Controller;




use App\Model\AdminModel;

class AdminControllerGame {


    public function insertGame($title, $desc, $price, $image, $date, $developper, $publisher, $checkboxArray, $category, $sub_category):void
    {
        $messages = [];

        $priceInt = (int)$price;
        $categoryInt= (int)$category;
        $sub_categoryInt= (int)$sub_category;

        function mempty($title, $desc, $price, $image, $date, $developper, $publisher , $category, $sub_category)
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

        $AdminModel = new AdminModel();
        $checkTitle = $AdminModel->checkIfTitleIsSet($title);




        if(preg_match("#^[0-9]*$#" , $price) && grapheme_strlen($desc) > 100 && mempty($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category && $checkTitle === 0 && $checkboxArray !== null))
        {
            $AdminModel = new AdminModel();
            $AdminModel->reqInsertGame($title, $desc, $priceInt, $image, $date, $developper, $publisher, $categoryInt, $sub_categoryInt);

            $this->setPlatform($checkboxArray);

            $messages['okAddGame'] = "You're game has been added to the product list";
        }
        else{
            if(!preg_match("#^[0-9]*$#", $price))
            {
                $messages['priceCheck'] = "The price must be only number";
            }
            if(grapheme_strlen($desc < 100))
            {
                $messages['lengthDesc'] = "The length of the description must be above 100 characters";
            }
            if(!mempty($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category))
            {
                $messages['emptyValues'] = "Fill all the field please";
            }
            if($checkTitle != 0)
            {
                $messages['titleTaken'] = "The game you are trying to insert is already in the database";
            }
            if($checkboxArray == null)
            {
                $messages['checkboxError'] = "Please check at least one platform";
            }


        }
        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;
    }

    public function updateGame($title, $desc, $price, $image, $date, $developper, $publisher, $checkboxArray, $category, $sub_category,$id):void
    {
        $messages = [];

        $priceInt = (int)$price;
        $categoryInt= (int)$category;
        $sub_categoryInt= (int)$sub_category;

        function mempty($title, $desc, $price, $image, $date, $developper, $publisher , $category, $sub_category)
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

        $AdminModel = new AdminModel();
        $checkTitle = $AdminModel->checkIfTitleIsSet($title);


        if(preg_match("#^[0-9]*$#" , $price) && grapheme_strlen($desc) > 100 && mempty($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category) && $checkTitle === 0)
        {
            $AdminModel = new AdminModel();
            $AdminModel->updateById($title, $desc, $priceInt, $image, $date, $developper, $publisher, $categoryInt, $sub_categoryInt,$id);

            $AdminModel->deleteCompat($id);

            $this->setPlatform($checkboxArray);

            $messages['okAddGame'] = "You're game has been updated";
        }
        else{
            if(!preg_match("#^[0-9]*$#", $price))
            {
                $messages['priceCheck'] = "The price must be only number";
            }
            if(grapheme_strlen($desc < 100))
            {
                $messages['lengthDesc'] = "The length of the description must be above 100 characters";
            }
            if(!mempty($title, $desc, $price, $image, $date, $publisher, $developper, $category, $sub_category))
            {
                $messages['emptyValues'] = "Fill all the field please";
            }
            if($checkTitle != 0)
            {
                $messages['titleTaken'] = "The game you are trying to insert is already in the database";
            }

        }
        $json = json_encode($messages, JSON_PRETTY_PRINT);
        echo $json;
    }

    public function setPlatform(array $arrayCheckbox):void {

        $AdminModel = new AdminModel();
        $id_game = $AdminModel->fetchLastGame();


        foreach ($arrayCheckbox as $key => $platform){
            $intPlatform = (int)$platform;

            $AdminModel->insertPlatform($id_game['id'], $intPlatform);
        }
    }

    public function fetchLastGame()
    {
        $AdminModel = new AdminModel();
        $AdminModel->fetchLastGame();
    }

    public function getPlatform():array
    {
        $AdminModel = new AdminModel();
        return $AdminModel->getPlatform();
    }

    public function displayGames()
    {
        $AdminModel = new AdminModel();
        $AdminModel->displayGames();
    }

    public function deleteGame($id)
    {
        $intId = (int)$id;

        if(gettype($intId) == 'integer')
        {
            $AdminModel = new AdminModel();
            $AdminModel->deleteGame($intId);
        }

    }

}
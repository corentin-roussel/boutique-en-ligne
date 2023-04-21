<?php

namespace App\Controller;

use App\Model\AdminModel;
use App\Model\ProfilModel;
use DateTime;

class ProfilController{

    public function showInfosProfil(){

        $modelDATA = new ProfilModel()  ;
        $getINFOS = $modelDATA->showInfoProfil();
        return $getINFOS;
    }


    public function updateInfoProfil(?string $login,?string $pass,?string $confpass,?string $email,?string $firstname,?string $lastname,?string $date,?string $phone){

        $login = htmlspecialchars(trim($login));
        $pass = htmlspecialchars(trim($pass));
        $confpass = htmlspecialchars(trim($confpass));
        $email = htmlspecialchars(trim($email));
        $model = new ProfilModel();
        $messages = [];


        
        if(!empty($login) && $pass == $confpass && !empty($email)){
            
            $passHash = password_hash($pass,PASSWORD_DEFAULT);
            $model->updateProfil($login,$passHash,$email);

            $_SESSION['user']['login'] = $login;
            $_SESSION['user']['email'] = $email;

            $messages['updateData'] = "Your profil is update";
        }elseif(isset($firstname) && isset($lastname) && isset($date) && isset($phone)){
            $model->insertProfil($firstname,$lastname,$date,$phone);
            $messages['updateData'] = "Your profil is update";

        }

        $messJSON = json_encode($messages,JSON_PRETTY_PRINT);
        echo $messJSON;



        
    }


}


?>
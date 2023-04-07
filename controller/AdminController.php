<?php

require_once 'model/AdminModel.php';

class AdminController
{

    private $model;

    public function __construct() {

        $this->model = new AdminModel;

    }

    public function GetAllRoles() {

        $roles = $this->model->GetAllRoles();

        $json = json_encode($roles, JSON_PRETTY_PRINT);
        echo $json;
    }

    public function GetUsersDataByRole($idRole) {

        $dataUsers = $this->model->GetUserDataByRoleId($idRole);

        $json = json_encode($dataUsers, JSON_PRETTY_PRINT);
        echo $json;

    }

    public function GetAllRoleExeptActual($idActualRole) {

        $roles = $this->model->GetAllRoleExeptActualById($idActualRole);

        $json = json_encode($roles, JSON_PRETTY_PRINT);
        echo $json;

    }

}
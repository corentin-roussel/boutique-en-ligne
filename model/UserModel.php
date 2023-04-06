<?php

class UserModel
{

    private PDO $conn;

    public function __construct() {

        $db_username = 'root';
        $db_password = '';
        
        try{

            $this->conn = new PDO('mysql:host=localhost;dbname=boutique_en_ligne;charset=utf8', $db_username, $db_password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch(PDOException $e){

            echo "Error : " . $e->getMessage();
        }
    }

    public function RowCount($table, $attributeToCount, $input) {

        $sql = "SELECT * FROM $table WHERE $attributeToCount = :input";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':input' => $input));
        $row = $req->rowCount();

        return $row;
    }

    public function InsertUserDb($login, $email, $hash) {

        $sql = "INSERT INTO user (`login`, `password`, `email`, `id_role`) VALUES (:login, :pass, :email, :id_role)";
        $req = $this->conn->prepare($sql);
        $req->execute(array(':login' => $login,
                            ':pass' => $hash,
                            ':email' => $email,
                            ':id_role' => 1
        ));

        return 'okSignup';
    }

    public function GetUserData($login) {

        $sql = "SELECT *,user.id FROM user INNER JOIN role ON user.id_role = role.id WHERE login=:login";
        $req = $this->conn->prepare($sql);
        $req->execute(array(':login' => $login));
        $tab = $req->fetch(PDO::FETCH_ASSOC);

        return $tab;
    }

    public function UpdateOneById($sessionId, $attributToChange, $newAttributValue, $table, $messageOk) {

        $sql = "UPDATE $table SET $attributToChange = :newAttributValue WHERE id = :sessionId";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':newAttributValue' => $newAttributValue,
                            ':sessionId' => $sessionId
        ));

        return $messageOk;
    }

    public function DeleteLine($table, $id) {

        $sql = "DELETE FROM $table WHERE id = :sessionId";
        
        $req = $this->conn->prepare($sql);
        $req->execute(array(':sessionId' => $id));

        return 'okDel';
    }
}















/*

public function LoginRowCount($login) {

    $sql = "SELECT * FROM utilisateurs WHERE login=:login";

    $req = $this->conn->prepare($sql);
    $req->execute(array(':login' => $login));
    $row = $req->rowCount();

    return $row;

}

public function UpdateLogin($sessionId, $login) {

    $sqlLog = "UPDATE user SET login = :login WHERE id = :sessionId";

    $req = $this->conn->prepare($sqlLog);
    $req->execute(array(':login' => $login, ':sessionId' => $sessionId));

    return 'okLog';

}

public function UpdatePassword($sessionId, $hash) {

    $sqlPass = "UPDATE user SET password = :hash WHERE id = :sessionId";

    $req = $this->conn->prepare($sqlPass);
    $req->execute(array(':hash' => $hash, ':sessionId' => $sessionId));

    return 'okPass';

}

*/

?>
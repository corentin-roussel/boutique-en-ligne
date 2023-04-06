<?php 
 namespace App\model;

require_once('./src/model/Model.php');

class PlateformModel extends Model

{


    public function __construc()
    {
        //empty
    }

    public function insertPlateform(string $plateform): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO platform(platform) VALUES(:content)');
        $stmt->bindParam(':content',$plateform);
        $stmt->execute();

    }

    public static function updatePlateform()
    {

    }

    public static function deletePlateform()
    {

    }
}

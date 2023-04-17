<?php
require_once("autoloader.php");

use App\model\PlateformModel;
use App\Controller\PlateformController;

$show_plateform = new PlateformModel();
$deleteModel = new PlateformController();
$plateform = $show_plateform->showPlateform();

// var_dump($_GET);
!isset($_GET['idPlat']) ?: $deleteModel->deletePlat($_POST['checkplat']);

// var_dump($_POST);
// var_dump($_GET);
// var_dump($_POST);

?>

<form action="" method="POST" id="form_check_plat">
    <table id="table_plate">
        <thead>
            <tr>
                <th>Platforms</th>
            </tr>
        </thead>
        <tbody id="tb_plat">
            <tr class="row_plat">
                <?php foreach ($plateform as $plat) : ?>
                    <td><label for="<?= $plat['id'] ?>"><?= $plat['platform'] ?></label>
                        <input type="checkbox" id="<?= $plat['id'] ?>" class="check_plat" name="checkplat[]" value="<?= $plat['id'] ?>">
                    </td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
    <button type="submit" id="del-plat" name="btn_del" value="">Delete Plateform</button>
</form>
<link rel="stylesheet" href="./styles/input-styles.css">
<?php
include_once '../DBConnection.php';
try {
    $acro = $_REQUEST["q"];
    $db = new DBConnection;
    $q = "select checkacro(:acro)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':acro' => $acro));
    $isthere = $stmt->fetchColumn();
    if (strlen($acro) > 5) {
        echo '<div class="form-group has-error has-feedback">'
        . '<input name="acro" type="text" class="form-control" style="color: black" id="acro" aria-invalid="true" value="' . $acro . '" onblur="checkAcro()">'
        . '<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>'
        . '<span class="help-block">Forkortelsen er for lang. Max 5 bogstaver.</span>'
        . '</div>';
    } else {
        if ($isthere === '1') {
            echo '<div class="form-group has-error has-feedback">'
            . '<input name="acro" type="text" class="form-control" style="color: black" id="acro" aria-invalid="true" value="' . $acro . '" onblur="checkAcro()">'
            . '<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>'
            . '<span class="help-block">Forkortelsen findes allerede i databasen.</span>'
            . '</div>';
        } else {
            if (empty($acro)) {
                echo '<div class="form-group">
                <input name="acro" type="text" class="form-control input-style" id="acro" placeholder="Forkortelse (max 5 bogstaver)" onblur="checkAcro()">
            </div>';
            } else {
                echo '<div class="form-group">'
                . '<input name="acro" type="text" class="form-control input-style" id="acro" value="' . $acro . '" onblur="checkAcro()">'
                . '</div>';
            }
        }
    }
} catch (PDOException $e) {
    echo '<div class="form-group">'
    . '<input name="acro" type="text" class="form-control input-style" id="acro" value="' . $acro . '" onblur="checkAcro()">'
    . '</div>';
    $e->getMessage();
}
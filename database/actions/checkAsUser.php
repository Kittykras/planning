<link rel="stylesheet" href="./styles/input-styles.css">
<?php
include_once '../DBConnection.php';
try {
    $user = $_REQUEST["q"];
    $db = new DBConnection;
    $q = "select checkuser(:user)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':user' => $user));
    $isthere = $stmt->fetchColumn();

    if (strlen($user) > 4) {
        echo '<div class="form-group has-error has-feedback">'
        . '<input name="newUser" type="text" class="form-control" style="color: black" id="newUser" value="' . $user . '" onblur="checkUser()">'
        . '<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>'
        . '<span class="help-block">Brugernavnet er for langt. Max 4 bogstaver.</span>'
        . '</div>';
    } else if ($isthere === '1') {
        echo '<div class="form-group has-error has-feedback">'
        . '<input name="newUser" type="text" class="form-control" style="color: black" id="newUser" value="' . $user . '" onblur="checkUser()">'
        . '<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>'
        . '<span class="help-block">Brugernavnet findes allerede i databasen.</span>'
        . '</div>';
    } else if (empty($user)) {
        echo '<div class="form-group">
                <input name="newUser" type="text" class="form-control input-style" id="newUser" placeholder="Brugernavn(max 4 bogstaver)" onblur="checkUser()">
            </div>';
    } else {
        echo '<div class="form-group">'
        . '<input name="newUser" type="text" class="form-control input-style" id="newUser" value="' . $user . '" onblur="checkUser()">'
        . '</div>';
    }
} catch (PDOException $e) {
    echo '<div class="form-group">'
    . '<input name="newUser" type="text" class="form-control input-styles" id="newUser" value="' . $user . '" onblur="checkUser()">'
    . '</div>';
    $e->getMessage();
}
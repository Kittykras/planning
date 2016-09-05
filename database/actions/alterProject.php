<?php

require_once '../DBConnection.php';

$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();

function htmlEntities2($str) {
    $text = str_replace("oe", "Ø", $str);
    $text = str_replace("aaa", "Å", $text);
    $text = str_replace("ae", "Æ", $text);
//    window.alert(text);
    return $text;
}

try{
    $id = $_COOKIE['Task'];
    $cus = htmlEntities2($_COOKIE["Kunde"]);
    $title = $_POST["title"];
    $assi = $_POST["assi"];
    $db = new DBConnection();
    $q = "call altermainprojekt(:id, :title, :cus, :assi);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':title' => $title, ':cus' => $cus, ':assi' => $assi));
    $count = $stmt->rowCount();
    if ($count > 0) {
        header("location:" . $_COOKIE['previous']);
    } else {
        header("location:../../projectForm.php?error");
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}


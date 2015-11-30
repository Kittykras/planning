<?php

require_once '../DBConnection.php';

function htmlEntities2($str) {
    $text = str_replace("oe", "ø", $str);
    $text = str_replace("aaa", "å", $text);
    $text = str_replace("ae", "æ", $text);
//    window.alert(text);
    return $text;
}

try {
    $oldUser = htmlEntities2($_COOKIE["UserName"]);
    $newName = $_POST["newName"];
    $newUser = $_POST["newUser"];
    $newPwd = $_POST["newPwd"];
    $newPriv = $_POST["newPriv"];
    $newMail = $_POST["newMail"];
    $db = new DBConnection();
    $q = "call alterassociate(:oldUser, :newUser, :newPwd, :newName, :newPriv, :newMail);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':oldUser' => $oldUser, ':newName' => $newName, ':newUser' => $newUser, ':newPwd' => $newPwd, ':newPriv' => $newPriv, ':newMail' => $newMail));
    $count = $stmt->rowCount();
    if ($stmt != FALSE) {
        setcookie("UserName", $newUser, time() + (86400), "/planning/");
        header("location:" . $_COOKIE['previous']);
    } else {
        header("location:../../associateForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


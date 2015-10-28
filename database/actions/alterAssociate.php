<?php
require_once '../DBConnection.php';

try{
    $oldUser = $_COOKIE["UserName"];
    $newName = $_POST["newName"];
    $newUser = $_POST["newUser"];
    $newPwd = $_POST["newPwd"];
    $newPriv = $_POST["newPriv"];
    $db = new DBConnection();
    $q = "call alterassociate(:oldUser, :newUser, :newPwd, :newName, :newPriv);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':oldUser' => $oldUser, ':newName' => $newName, ':newUser' => $newUser, ':newPwd' => $newPwd, ':newPriv' => $newPriv));
    $count = $stmt->rowCount();
    if($count == 1){
        setcookie("UserName", $newUser, time() + (86400), "/vonbulowPlanning/");
        header("location:../../enkeltMedarbejder.php");
    } else {
        header("location:../../opretMedarbejder.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
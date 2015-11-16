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
    if($stmt != FALSE){
        setcookie("UserName", $newUser, time() + (86400), "/planning/");
        header("location:../../singleAssociate.php");
    } else {
        header("location:../../associateForm.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
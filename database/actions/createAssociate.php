<?php
require_once '../DBConnection.php';

try{
    $newName = $_POST["newName"];
    $newUser = $_POST["newUser"];
    $newPwd = $_POST["newPwd"];
    $newPriv = $_POST["newPriv"];
    $newMail = $_POST["newMail"];
    $db = new DBConnection();
    $q = "call createassociate(:newUser, :newPwd, :newName, :newPriv, :newMail);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':newName' => $newName, ':newUser' => $newUser, ':newPwd' => $newPwd, ':newPriv' => $newPriv, ':newMail' => $newMail));
    $count = $stmt->rowCount();
    if($count == 1){
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../associateForm.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
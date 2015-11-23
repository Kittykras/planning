<?php
require_once '../DBConnection.php';

try{
    $newName = $_POST["newName"];
    $newUser = $_POST["newUser"];
    $newPwd = $_POST["newPwd"];
    $newPriv = $_POST["newPriv"];
    $db = new DBConnection();
    $q = "call createassociate(:newUser, :newPwd, :newName, :newPriv);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':newName' => $newName, ':newUser' => $newUser, ':newPwd' => $newPwd, ':newPriv' => $newPriv));
    $count = $stmt->rowCount();
    if($count == 1){
        SetCookie('medarbejder', 'active', time() + (86400), "/planning/");
        SetCookie('kunder', '', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../associateForm.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
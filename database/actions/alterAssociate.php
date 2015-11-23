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
        SetCookie('medarbejder', 'active', time() + (86400), "/planning/");
        SetCookie('kunder', '', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        setcookie('orderby', 't_fromweek', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../associateForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
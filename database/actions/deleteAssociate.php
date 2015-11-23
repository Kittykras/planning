<?php
require_once '../DBConnection.php';

try{
    $delName = $_COOKIE["UserName"];
    $db = new DBConnection();
    $q = "call deleteassociate(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($stmt != FALSE){
        SetCookie('medarbejder', 'active', time() + (86400), "/planning/");
        SetCookie('kunder', '', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../singleAssociate.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
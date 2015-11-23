<?php
require_once '../DBConnection.php';

try{
    $delName = $_COOKIE["Kunde"];
    $db = new DBConnection();
    $q = "call deletecustomer(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($stmt != FALSE){
        SetCookie('medarbejder', '', time() + (86400), "/planning/");
        SetCookie('kunder', 'active', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        setcookie('orderby', 'c_name', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../singleCustomer.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
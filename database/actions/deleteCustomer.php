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
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../singleCustomer.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
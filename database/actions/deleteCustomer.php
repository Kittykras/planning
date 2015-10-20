<?php
require_once '../DBConnection.php';

try{
    $delName = $_COOKIE["Kunde"];
    $db = new DBConnection();
    $q = "call deletecustomer(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($count == 1){
        header("location:../../kunder.php");
    } else {
        header("location:../../enkeltKunde.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
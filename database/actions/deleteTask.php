<?php
require_once '../DBConnection.php';

try{
    $delName = $_COOKIE["Task"];
    $db = new DBConnection();
    $q = "call deletetask(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($count == 1){
        header("location:../../enkeltKunde.php");
    } else {
        header("location:../../opretOpgave.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
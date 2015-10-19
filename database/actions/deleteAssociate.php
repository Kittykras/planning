<?php
require_once '../DBConnection.php';

try{
    $delName = $_COOKIE["UserName"];
    $db = new DBConnection();
    $q = "call deleteassociate(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($count == 1){
        header("location:../../medarbejdere.php");
    } else {
        header("location:../../enkeltMedarbejder.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
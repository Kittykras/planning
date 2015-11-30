<?php
require_once '../DBConnection.php';

try{
    $delName = htmlEntities2($_COOKIE["UserName"]);
    $db = new DBConnection();
    $q = "call deleteassociate(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($stmt != FALSE){
        header("location:../../associates.php");
    } else {
        header("location:../../singleAssociate.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


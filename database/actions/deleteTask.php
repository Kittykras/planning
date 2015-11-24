<?php
require_once '../DBConnection.php';

try{
    $delName = $_COOKIE["Task"];
    $db = new DBConnection();
    $q = "call deletetask(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName"=>$delName));
    $count = $stmt->rowCount();
    if($stmt != FALSE){
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../taskForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
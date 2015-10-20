<?php
require_once '../DBConnection.php';

try{
    $oldCus = $_COOKIE["Kunde"];
    $name = $_POST["name"];
    $acro = $_POST["acro"];
    $cont = $_POST["cont"];
    $tlf = $_POST["tlf"];
    $bran = $_POST["bran"];
    $assi= $_POST["assi"];
    $db = new DBConnection();
    $q = "call altercustomer(:oldCus, :acro, :name, :bran, :cont, :tlf, :assi);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':oldCus' => $oldCus,':acro' => $acro, ':name' => $name, ':bran' => $bran, ':cont' => $cont, ':tlf' => $tlf, ':assi' => $assi));
    $count = $stmt->rowCount();
    if($count == 1){
        header("location:../../kunder.php");
    } else {
        header("location:../../opretKunde.php?editing = edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
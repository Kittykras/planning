<?php
require_once '../DBConnection.php';

try{
    $cus = $_COOKIE["Kunde"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $stat = $_POST["stat"];
    $assi = $_POST["assi"];
    $timespen = $_POST["hour"].":".$_POST["min"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $comment = $_POST["comment"];
    $db = new DBConnection();
    $q = "call createtask(:cus, :title, :descr, :stat, :assi, :timespent, :from, :to);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':cus' => $cus, ':title' => $title, ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen, ':from' => $from, ':to' => $to));
    $q = "call createcommentonnewtask(:comment, :user);";
    $stmt2 = $db->prepare($q);
    $stmt2->execute(array(':comment' => $comment, ":user" => $_SESSION["user"]->a_username));
    $count = $stmt->rowCount();
    if($count == 1){
        header("location:../../enkeltKunde.php");
    } else {
        header("location:../../opretOpgave.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
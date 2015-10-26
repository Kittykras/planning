<?php
require_once '../DBConnection.php';
session_start();
try{
    $user = $_SESSION["user"]->a_username;;
    $cus = $_COOKIE["Kunde"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $stat = $_POST["stat"];
    $assi = $_POST["assi"];
    $timespen = $_POST["hour"].":".$_POST["min"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $comment = $_POST["newComment"];
    $inv = $_POST["inv"];
    $exp = $_POST["exp"];
    $db = new DBConnection();
    $q = "call createtask(:cus, :title, :descr, :stat, :assi, :timespent, :from, :to, :inv, :exp);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':cus' => $cus, ':title' => $title, ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen, ':from' => $from, ':to' => $to, ':inv' => $inv, ':exp' => $exp));
    $count = $stmt->rowCount();
    $q = "call createcommentonnewtask(:comment, :user);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':comment' => $comment, ":user" => $user));
    if($count == 1){
        header("location:../../enkeltKunde.php");
    } else {
        header("location:../../opretOpgave.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
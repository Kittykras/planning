<?php

require_once '../DBConnection.php';
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $cus = $_COOKIE["Kunde"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $stat = $_POST["stat"];
    $assi = $_POST["assi"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $comment = $_POST["newComment"];
    $db = new DBConnection();
    $q = "call altertask(:id, :cus, :title, :descr, :stat, :assi, :timespent, :from, :to);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':cus' => $cus, ':title' => $title, ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen, ':from' => $from, ':to' => $to));
    $count = $stmt->rowCount();
    $commentcount = 0;
    if ($comment != "") {
        $q = "call createcomment(:id, :comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':id' => $id, ':comment' => $comment, ":user" => $user));
        $commentcount = $stmt->rowCount();
    }
    if ($count == 1 || $commentcount == 1) {
        header("location:../../enkeltKunde.php");
    } else {
//        header("location:../../opretOpgave.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
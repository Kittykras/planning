<?php

require_once '../DBConnection.php';
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $cus = $_POST["cus"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $stat = $_POST["stat"];
    $assi = $_POST["assi"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $fromArray = split('\-',$_POST["from"]);
    $fromYear = $fromArray[0];
    $fromWeek = $fromArray[1];
    $toArray = split('\-', $_POST["to"]);
    $toYear = $toArray[0];
    $toWeek = $toArray[1];
    $comment = $_POST["newComment"];
    $inv = $_POST["inv"];
    $exp = $_POST["exp"];
    $db = new DBConnection();
    $q = "call altertask(:id, :cus, :title, :descr, :stat, :assi, :timespent, :fromWeek, :fromYear, :toWeek, :toYear, :inv, :exp);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':cus' => $cus, ':title' => $title, ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen, ':fromWeek' => $fromWeek,':fromYear' => $fromYear, ':toWeek' => $toWeek,':toYear' => $toYear, ':inv' => $inv, 'exp' => $exp));
    $count = $stmt->rowCount();
    $commentcount = 0;
    if ($comment != "") {
        $q = "call createcomment(:id, :comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':id' => $id, ':comment' => $comment, ":user" => $user));
        $commentcount = $stmt->rowCount();
    }
    if ($count == 1) {
        setcookie('Kunde', $cus, time() + (86400), "/planning/");
        header("location:../../singleCustomer.php");
    } else {
        header("location:../../taskForm.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
<?php 
require_once '../DBConnection.php';
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $cus = $_COOKIE["Kunde"];
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
    $q = "call createtask(:user, :cus, :title, :descr, :stat, :assi, :timespent,"
            . " :fromWeek, :fromYear, :toWeek, :toYear, :inv, :exp);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':user' => $user, ':cus' => $cus, ':title' => $title, 
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen,
        ':fromWeek' => $fromWeek,':fromYear' => $fromYear, ':toWeek' => $toWeek, ':toYear' => $toYear, ':inv' => $inv, ':exp' => $exp));
    $count = $stmt->rowCount();
    if ($comment === "") {
        $commentDate = '0000-00-00 00:00:00';
        $q = "call createcommentonnewtask(:comment, :user, :commentDate);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user, ":commentDate" => $commentDate));
    } else {
        $commentDate = '0000-00-00 00:00:00';
        $q = "call createcommentonnewtask(:comment, :user, :commentDate);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user, ":commentDate" => $commentDate));
        $commentDate = date('Y-m-d H:i:s');
        $q = "call createcommentonnewtask(:comment, :user, :commentDate);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user, ":commentDate" => $commentDate));
    }
    if ($count > 0) {
        header("location:../../enkeltKunde.php");
    } else {
        header("location:../../opretOpgave.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
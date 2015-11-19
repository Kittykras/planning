<?php

require_once '../DBConnection.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
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
    $fromArray = split('\-', $_POST["from"]);
    $fromYear = $fromArray[0];
    $fromWeek = $fromArray[1];
    $toArray = split('\-', $_POST["to"]);
    $toYear = $toArray[0];
    $toWeek = $toArray[1];
    $comment = $_POST["newComment"];
    $press = isset($_POST['press']) && $_POST['press'] ? "true" : "false";
    $pressdate = $_POST["pressdate"];
    $pressrelease = "";
    if ($pressdate === "") {
        $pressrelease = "0000-00-00";
    } else {
        $datearray = split('\/', $pressdate);
        $day = $datearray[1];
        $month = $datearray[0];
        $year = $datearray[2];
        $pressrelease = $year . '-' . $month . '-' . $day;
    }
    $db = new DBConnection();
    $q = "call altertask(:id, :cus, :title, :descr, :stat, :assi, :timespent, :fromWeek, :fromYear, :toWeek, :toYear, :pressrelease, :press);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id,':cus' => $cus, ':title' => $title,
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen,
        ':fromWeek' => $fromWeek, ':fromYear' => $fromYear, ':toWeek' => $toWeek, ':toYear' => $toYear, ':pressrelease' => $pressrelease, ':press' => $press));
    if ($comment != "") {
        $q = "call createcommentonnewtask(:comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user));
    }
    if ($stmt != FALSE) {
        SetCookie('medarbejder', '', time() + (86400), "/planning/");
        SetCookie('kunder', 'active', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        setcookie('orderby', 't_fromweek', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        header("location:../../singleCustomer.php");
    } else {
        header("location:../../taskForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
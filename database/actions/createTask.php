<?php

require_once '../DBConnection.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();
try {
    $user = $_SESSION["user"]->a_username;
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
    if ($pressdate === "") {
        $pressdate = "0000-00-00";
    } 
    $db = new DBConnection();
    $q = "call createtask(:cus, :title, :descr, :stat, :assi, :timespent, :fromWeek, :fromYear, :toWeek, :toYear, :pressdate, :press);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':cus' => $cus, ':title' => $title,
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen,
        ':fromWeek' => $fromWeek, ':fromYear' => $fromYear, ':toWeek' => $toWeek, ':toYear' => $toYear, ':pressdate' => $pressdate, ':press' => $press));
    $count = $stmt->rowCount();
    if ($comment != "") {
        $q = "call createcommentonnewtask(:comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user));
    }
    if ($count > 0) {
        SetCookie('medarbejder', '', time() + (86400), "/planning/");
        SetCookie('kunder', 'active', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        setcookie('orderby', 't_fromweek', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../taskForm.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
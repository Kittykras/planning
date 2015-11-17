<?php

require_once '../DBConnection.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $cus = $_POST["cus"];
    $stat = $_POST["stat"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $comment = $_POST["newComment"];
    $press = isset($_POST['press']) && $_POST['press']  ? "true" : "false";
    $db = new DBConnection();
    $q = "call altertasknopriv(:id, :stat, :timespent, :press)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':stat' => $stat, ':timespent' => $timespen, ':press' => $press));
//    $count = $stmt->rowCount();
//    $commentcount = 0;
    if ($comment != "") {
        $q = "call createcomment(:id, :comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':id' => $id, ':comment' => $comment, ":user" => $user));
//        $commentcount = $stmt->rowCount();
    }
    if ($stmt != FALSE) {
        setcookie('Kunde', $cus, time() + (86400), "/planning/");
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
        header("location:../../taskForm.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
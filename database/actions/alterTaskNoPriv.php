<?php

require_once '../DBConnection.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $stat = $_POST["stat"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $comment = $_POST["newComment"];
    $db = new DBConnection();
    $q = "call altertasknopriv(:id, :stat, :timespent)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':stat' => $stat, ':timespent' => $timespen));
    $count = $stmt->rowCount();
    $commentcount = 0;
    if ($comment != "") {
        $q = "call createcomment(:id, :comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':id' => $id, ':comment' => $comment, ":user" => $user));
        $commentcount = $stmt->rowCount();
    }
    if ($count == 1 || $commentcount == 1) {
        header("location:../../singleCustomer.php");
    } else {
        header("location:../../taskForm.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
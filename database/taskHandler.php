<?php

require_once 'DBConnection.php';
//require_once 'classes/Task.php';

$db = new DBConnection();
$orderby = $_COOKIE["orderby"];
$false = $_COOKIE["state"];
$q = 'call getalltask(:false, :orderby)';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(array(':false' => $false, ':orderby' => $orderby));
$tasks = $stmt->fetchAll();

function getComments() {
    $db = new DBConnection();
    $q = "call getAllComments(:task)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':task' => $_COOKIE["Task"]));
    $taskComments = $stmt->fetchAll();
    return $taskComments;
}

function getTaskFromCookie() {
    $db = new DBConnection();
    $q = "call getTask(:id)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $_COOKIE["Task"]));
    $task = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Task"] = $task;
}

function getTaskFromPress() {
    $db = new DBConnection();
    $orderby = $_COOKIE["orderby"];
    $state = $_COOKIE["state"];
    $q = 'call getalltaskbypress(:state, :orderby)';
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':state' => $state, ':orderby' => $orderby));
    $ptasks = $stmt->fetchAll();
    return $ptasks;
}

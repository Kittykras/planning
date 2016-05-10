<?php

require_once 'DBConnection.php';
//require_once 'classes/Task.php';

$db = new DBConnection();
$orderby = $_COOKIE["orderby"];
$false = $_COOKIE["state"];
$showtask = $_COOKIE['showtask'];
$q = 'call getalltask(:false, :orderby, :showtask)';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(array(':false' => $false, ':orderby' => $orderby, ':showtask' => $showtask));
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

function  getProjectFromCookie(){
    $db = new DBConnection();
    $q = "call getmaintask(:id)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $_COOKIE["Task"]));
    $project = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Project"] = $project;
}

function getTasksFromProject(){
    $db = new DBConnection();
    $id = $_COOKIE['Task'];
    $q = "call gettaskrelatedtoMain(:id)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id));
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $protasks = $stmt->fetchAll();
    return $protasks;
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

function getTaskFromOnline(){
    $db = new DBConnection();
    $orderby = $_COOKIE["orderby"];
    $state = $_COOKIE["state"];
    $q = 'call getalltaskbyonline(:state, :orderby)';
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':state' => $state, ':orderby' => $orderby));
    $otasks = $stmt->fetchAll();
    return $otasks;
}

function getExpFromTask(){
    $db = new DBConnection();
    $q = "call getexpenses(:id)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':id' => $_COOKIE["Task"]));
    $expenses = $stmt->fetchAll();
    return $expenses;
}

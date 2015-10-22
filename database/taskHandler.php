<?php
require_once 'DBConnection.php';
//require_once 'classes/Task.php';

$db = new DBConnection();
$q = 'call getalltask()';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$tasks = $stmt->fetchAll();

function getComments(){
    $db = new DBConnection();
    $q = "call getcomment(:task)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':task' => $_COOKIE["Task"]));
    $taskComment = $stmt->fetch(PDO::FETCH_OBJ);
    return $taskComment;
}
function getTaskFromCookie(){
    $db = new DBConnection();
    $q = "call getTask(:id)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $_COOKIE["Task"]));
    $task = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Task"] = $task;
}

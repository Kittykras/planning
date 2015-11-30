<?php

require_once 'DBConnection.php';
require_once 'classes/User.php';

$db = new DBConnection();
$q = 'call getallassociate()';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
$stmt->execute();
$users = $stmt->fetchAll();

//print_r($users);
function getTasksFromAs() {
    $db = new DBConnection();
    $orderby = $_COOKIE["orderby"];
    $state = $_COOKIE["state"];
    $username = htmlEntities2($_COOKIE["UserName"]);
    $q = "call getallTaskbyas(:username, :state, :orderby)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':username' => $username, ':state' => $state, ':orderby' => $orderby));
    $atasks = $stmt->fetchAll();
    return $atasks;
}

function getUserFromCookie() {
    $db = new DBConnection();
    $q = "call getassociate(:username)";
    $stmt = $db->prepare($q);
    $userac = htmlEntities2($_COOKIE["UserName"]);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':username' => $userac));
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["UserName"] = $user;
}

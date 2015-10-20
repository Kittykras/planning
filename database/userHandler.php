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
function getUserFromCookie() {
    $db = new DBConnection();
    $q = "call getassociate(:username)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':username' => $_COOKIE["UserName"]));
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["UserName"] = $user;
}

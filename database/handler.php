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
    $q = "call getassociate(" + $_COOKIE["UserName"] + ")";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    $user = $stmt->fetchObj();
    return $user;
}

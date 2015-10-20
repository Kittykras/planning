<?php

require_once 'DBConnection.php';
require_once 'classes/Customer.php';

$db = new DBConnection();
$q = 'call getallcustomer()';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Customer');
$stmt->execute();
$customers = $stmt->fetchAll();

////print_r($users);
//function getUserFromCookie() {
//    $db = new DBConnection();
//    $q = "call getassociate(:username)";
//    $stmt = $db->prepare($q);
////    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
//    $stmt->execute(array(':username' => $_COOKIE["UserName"]));
//    $user = $stmt->fetch(PDO::FETCH_OBJ);
//    $_SESSION["UserName"] = $user;
//}

<?php

require_once 'DBConnection.php';
require_once 'classes/Customer.php';

$db = new DBConnection();
$orderby = $_COOKIE["orderby"];
$q = 'call getallcustomer(:orderby)';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Customer');
$stmt->execute(array(':orderby' => $orderby));
$customers = $stmt->fetchAll();
$db = new DBConnection();
$orderby = 'c_name';
$q = 'call getallcustomer(:orderby)';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Customer');
$stmt->execute(array(':orderby' => $orderby));
$menucustomers = $stmt->fetchAll();

////print_r($users);

function getTasksFromCustomer() {
    $db = new DBConnection();
    $q = "call getallTaskfromcus(:acronym)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':acronym' => $_COOKIE["Kunde"]));
    $ctasks = $stmt->fetchAll();
    return $ctasks;
}
function getCustomerFromCookie() {
    $db = new DBConnection();
    $q = "call getCustomer(:acronym)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':acronym' => $_COOKIE["Kunde"]));
    $customer = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Kunde"] = $customer;
}

function getAssignedAssociateName($username){
    $db = new DBConnection();
    $q = "call getAssociate(:assigned)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':assigned' => $username));
    $associate = $stmt->fetch(PDO::FETCH_OBJ);
    return $associate->a_name;
}

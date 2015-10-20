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
function getCustomerFromCookie() {
    $db = new DBConnection();
    $q = "call getCustomer(:acronym)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':acronym' => $_COOKIE["Kunde"]));
    $customer = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Kunde"] = $customer;
}

function getAssignedAssociateName(){
    $db = new DBConnection();
    $q = "call getAssociate(:assigned)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':assigned' => $_SESSION["Kunde"]->c_assigned));
    $associate = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Assigned"] = $associate;
}

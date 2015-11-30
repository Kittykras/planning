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

function getLinksFromCustomerEdit() {
    if (isset($_GET["edit"])) {
        $db = new DBConnection();
        $acro = $_COOKIE["Kunde"];
        $q = "call getcusdesti(:acro)";
        $stmt = $db->prepare($q);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute(array(':acro' => $acro));
        $links = $stmt->fetchAll();
        return $links;
    }
}

function getLinksFromCustomer() {
    $db = new DBConnection();
//    $acro = $_COOKIE["Kunde"];
    $acro = $_COOKIE["Kunde"];
    $acro = htmlEntities2($acro);
    $q = "call getcusdesti(:acro)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':acro' => $acro));
    $links = $stmt->fetchAll();
    return $links;
}

function getTasksFromCustomer() {
    $db = new DBConnection();
    $orderby = $_COOKIE["orderby"];
    $state = $_COOKIE["state"];
//    $acronym = $_COOKIE["Kunde"];
    $acronym = $_COOKIE["Kunde"];
    $acronym = htmlEntities2($acronym);
    $q = "call getallTaskfromcus(:acronym, :state, :orderby)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':acronym' => $acronym, ':state' => $state, ':orderby' => $orderby));
    $ctasks = $stmt->fetchAll();
    return $ctasks;
}

function getCustomerFromCookie() {
    $db = new DBConnection();
    $q = "call getCustomer(:acronym)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $cusac = $_COOKIE["Kunde"];
    $cusac = htmlEntities2($cusac);
    $stmt->execute(array(':acronym' => $cusac));
    $customer = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION["Kunde"] = $customer;
}

function getAssignedAssociateName($username) {
    $db = new DBConnection();
    $q = "call getAssociate(:assigned)";
    $stmt = $db->prepare($q);
//    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute(array(':assigned' => $username));
    $associate = $stmt->fetch(PDO::FETCH_OBJ);
    return $associate->a_name;
}

function htmlEntities2($str) {
    $text = str_replace("oe", "ø", $str);
    $text = str_replace("aaa", "å", $text);
    $text = str_replace("ae", "æ", $text);
//    window.alert(text);
    return $text;
}

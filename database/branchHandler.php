<?php

require_once 'DBConnection.php';
require_once 'classes/Customer.php';

$db = new DBConnection();
$q = 'call getallbranch()';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$branches = $stmt->fetchAll();
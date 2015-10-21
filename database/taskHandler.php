<?php
require_once 'DBConnection.php';
//require_once 'classes/Task.php';

$db = new DBConnection();
$q = 'call getalltask()';
$stmt = $db->prepare($q);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$tasks = $stmt->fetchAll();

<?php

include_once '../DBConnection.php';
try {
    $oldBranch = $_POST['oldBranch'];
    $newBranch = $_POST['branch'];
    $db = new DBConnection();
    $q = "call alterbranch(:oldBranch, :newBranch)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':oldBranch' => $oldBranch, ':newBranch' => $newBranch));
    $count = $stmt->rowCount();
    if ($stmt != FALSE) {
        header("location:" . $_COOKIE['previous']);
    } else {
        header("location:../../customers.php?error");
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
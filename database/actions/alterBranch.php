<?php
include_once '../DBConnection.php';
try {
    $oldBranch = $_POST['oldBranch'];
    $branch = $_POST['branch'];
    $db = new DBConnection();
    $q = "call createBranch(:oldBranch, :branch)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':oldBranch' => $oldBranch,':branch' => $branch));
    $count = $stmt->rowCount();
    if ($count === 1) {
        header("location:../../customers.php");
    } else {
        header("location:../../customers.php?error");
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
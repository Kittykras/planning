<?php
include_once '../DBConnection.php';
try {
    $oldBranch = $_POST['oldBranch'];
    $newBranch = $_POST['branch'];
    $db = new DBConnection();
    $q = "call alterbranch(:oldBranch, :newBranch)";
    $stmt = $db->prepare($q);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute(array(':oldBranch' => $oldBranch,':newBranch' => $newBranch));
    $count = $stmt->rowCount();
    if ($stmt != FALSE) {
        SetCookie('medarbejder', '', time() + (86400), "/planning/");
        SetCookie('kunder', 'active', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        setcookie('orderby', 'c_name', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        header("location:../../customers.php");
    } else {
        header("location:../../customers.php?error");
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
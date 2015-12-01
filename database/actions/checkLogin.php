<?php

require_once '../DBConnection.php';
try {
    $username = $_POST["user"];
    $pass = $_POST["pwd"];
    $db = new DBConnection();
    $q = "call logon(:username,:pass)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':username' => $username, ':pass' => $pass));
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $stmt->rowCount();
    if ($count == 1) {
        $session_expiration = time() + 3600 * 24; // +1 days
        session_set_cookie_params($session_expiration);
        session_start();
        $_SESSION["user"] = $result;
        $cookie = $_SESSION["user"]->a_username;
        setcookie("orderby", 't_fromweek', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        setcookie("UserName", $cookie, time() + (86400), "/planning/");
        SetCookie('medarbejder', '', time() + (86400), "/planning/");
        SetCookie('kunder', '', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        SetCookie('online', '', time() + (86400), "/planning/");
        setcookie('login', 'active', time() + (86400), "/planning/");
        header("location:../../singleAssociate.php");
        $db->close();
    } else {
        header("location:../../index.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<?php

require_once '../DBConnection.php';

function htmlEntities2($str) {
        $text = str_replace("oe", "Ø", $str);
        $text = str_replace("aaa", "Å", $text);
        $text = str_replace("ae", "Æ", $text);
//    window.alert(text);
        return $text;
    }

try {
    $delName = $_COOKIE["Task"];
    $db = new DBConnection();
    $q = "call deletetask(:delName);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":delName" => $delName));
    $count = $stmt->rowCount();
    if ($stmt != FALSE) {
        session_start();
        $previous = $_COOKIE['previous'];
        $associate = htmlEntities2($_COOKIE['UserName']);
        $loggedin = $_SESSION['user']->a_username;
        if (strpos($previous, 'ssociate') != FALSE) {
            setcookie('kunder', '', time() + (86400), "/planning/");
            if ($associate === $loggedin) {
                setcookie('login', 'active', time() + (86400), "/planning/");
            } else {
                setcookie('medarbejder', 'active', time() + (86400), "/planning/");
            }
        } else if (strpos($previous, 'time') != FALSE) {
            setcookie('kunder', '', time() + (86400), "/planning/");
            setcookie('timeoversigt', 'active', time() + (86400), "/planning/");
        } else if (strpos($previous, 'overview') != FALSE) {
            setcookie('kunder', '', time() + (86400), "/planning/");
            setcookie('overblik', 'active', time() + (86400), "/planning/");
        } else if (strpos($previous, 'press') != FALSE) {
            setcookie('kunder', '', time() + (86400), "/planning/");
            setcookie('presse', 'active', time() + (86400), "/planning/");
        }
        header("location:" . $previous);
    } else {
        header("location:../../taskForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

<?php

require_once '../DBConnection.php';
require_once '../taskHandler.php';

function htmlEntities2($str) {
    $text = str_replace("oe", "Ø", $str);
    $text = str_replace("aaa", "Å", $text);
    $text = str_replace("ae", "Æ", $text);
//    window.alert(text);
    return $text;
}
try {
    $project = $_COOKIE['Task'];
    $db = new DBConnection();
    $tasks = getTasksFromProject();
    foreach ($tasks as $task) {
        $q = "call deletetask(:delName);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(":delName" => $task->t_id));
    }
    $q = "delete from mainprojekt where m_id = :mainid";
    $stmt = $db->prepare($q);
    $stmt->execute(array(":mainid" => $project));
    if ($stmt != FALSE) {
        header("location:../../customers.php");
    } else {
        header("location:../../projektForm.php?edit&error");
    }
} catch (PDOException $exc) {
    echo $exc->getMessage();
}






<?php

require_once '../DBConnection.php';
require_once '../../mailHandler.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $cus = $_COOKIE["Kunde"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $stat = $_POST["stat"];
    $assi = $_POST["assi"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $from = $_POST["from"];
    if (empty($from)) {
        $fromYear = 0;
        $fromWeek = 0;
    } else {
        $fromArray = split('\-', $from);
        $fromYear = $fromArray[0];
        $fromWeek = $fromArray[1];
    }
    $to = $_POST["to"];
    if (empty($to)) {
        $toYear = 0;
        $toWeek = 0;
    } else {
        $toArray = split('\-', $to);
        $toYear = $toArray[0];
        $toWeek = $toArray[1];
    }
    $comment = $_POST["newComment"];
    $mailto = $_POST["mailto"];
    $press = isset($_POST['press']) && $_POST['press'] ? "true" : "false";
    $pressdate = $_POST["pressdate"];
    if ($pressdate === "") {
        $pressdate = "0000-00-00";
    }
    $db = new DBConnection();
    $q = "call createtask(:cus, :title, :descr, :stat, :assi, :timespent, :fromWeek, :fromYear, :toWeek, :toYear, :pressdate, :press);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':cus' => $cus, ':title' => $title,
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen,
        ':fromWeek' => $fromWeek, ':fromYear' => $fromYear, ':toWeek' => $toWeek, ':toYear' => $toYear, ':pressdate' => $pressdate, ':press' => $press));
    $count = $stmt->rowCount();
    if ($comment != "") {
        $q = "call createcommentonnewtask(:comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user));
        $q = "call getAssociate(:mailto)";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':mailto' => $mailto));
        $asmail = $stmt->fetch(PDO::FETCH_OBJ);
        sendmail($asmail->a_email, 'Ny kommentar på en opgave', 'Kunde: '.$cus.'<br><br>Opgave: '.$title.'<br><br>'.$user.' har tilføjet en kommentar<br>'.$comment);
    }
    if ($count > 0) {
        header("location:" . $_COOKIE['previous']);
    } else {
        header("location:../../taskForm.php?error");
    }
} catch (PDOException $en) {
    echo $e->getMessage();
} catch (phpmailerException $pme){
    echo $pme->getMessage();
}
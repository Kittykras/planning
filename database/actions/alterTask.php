<?php

require_once '../DBConnection.php';
require_once '../../mailHandler.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();
try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $cus = $_POST["cus"];
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
    $q = "call altertask(:id, :cus, :title, :descr, :stat, :assi, :timespent, :fromWeek, :fromYear, :toWeek, :toYear, :pressdate, :press);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':cus' => $cus, ':title' => $title,
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen,
        ':fromWeek' => $fromWeek, ':fromYear' => $fromYear, ':toWeek' => $toWeek, ':toYear' => $toYear, ':pressdate' => $pressdate, ':press' => $press));
    if ($comment != "") {
        $q = "call createcomment(:id, :comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':id' => $id, ':comment' => $comment, ":user" => $user));
        if ($mailto != "") {
            $q = "call getAssociate(:mailto)";
            $stmt = $db->prepare($q);
            $stmt->execute(array(':mailto' => $mailto));
            $asmail = $stmt->fetch(PDO::FETCH_OBJ);
            sendmail($asmail->a_email, 'Ny kommentar på en opgave', 'Kunde: ' . $cus . '<br><br>Opgave: ' . $title . '<br><br>' . $user . ' har tilføjet en kommentar:<br>' . $comment);
        }
    }
    if ($stmt != FALSE) {
        setcookie("Kunde", $cus, time() + (86400), "/planning/");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $previous = $_COOKIE['previous'];
        $associate = $_COOKIE['UserName'];
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
} catch (phpmailerException $pme) {
    echo $pme->getMessage();
}
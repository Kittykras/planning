<?php

require_once '../DBConnection.php';
require_once '../../mailHandler.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();

function htmlEntities2($str) {
    $text = str_replace("oe", "Ø", $str);
    $text = str_replace("aaa", "Å", $text);
    $text = str_replace("ae", "Æ", $text);
    return $text;
}

try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $cus = $_POST["cus"];
    $title = $_POST["title"];
    $descr = $_POST["descr"];
    $stat = $_POST["stat"];
    $assi = $_POST["assi"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $comment = $_POST["newComment"];
    $mailto = $_POST["mailto"];
    $press = isset($_POST['press']) && $_POST['press'] ? "true" : "false";
    $online = isset($_POST['online']) && $_POST['online'] ? "true" : "false";
    $pressdate = $_POST["pressdate"];
    if ($pressdate === "") {
        $pressdate = "0000-00-00";
    }
    $project = $_POST["project"];
    echo "mainid = ".$project;
    $db = new DBConnection();
    $q = "call altertask(:id, :cus, :title, :descr, :stat, :assi, :timespent, :pressdate, :press, :online, :mainid);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':cus' => $cus, ':title' => $title,
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen,':pressdate' => $pressdate, ':press' => $press, ':online' => $online, ':mainid' => $project));
    $q2 = "call setmainprojektstate(:mainid)";
    $stmt2 = $db->prepare($q2);
    $stmt2->execute(array(':mainid' => $project));
    if ($comment != "") {
        $q = "call createcomment(:id, :comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':id' => $id, ':comment' => $comment, ":user" => $user));
        if (isset($mailto)) {
            $mails = array();
            foreach ($mailto as $mail) {
                $q = "call getAssociate(:mailto)";
                $stmt = $db->prepare($q);
                $stmt->execute(array(':mailto' => $mail));
                $asmail = $stmt->fetch(PDO::FETCH_OBJ);
                array_push($mails, $asmail->a_email);
            }
            sendmail($mails, 'Ny kommentar på en opgave', 'Kunde: ' . $cus . '<br><br>Opgave: ' . $title . '<br><br>' . $user . ' har tilføjet en kommentar:<br>' . $comment);
        }
    }
    if ($stmt != FALSE) {
        setcookie("Kunde", $cus, time() + (86400), "/planning/");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $previous = $_COOKIE['previous'];
        setcookie('Task', $project, time() + (86400), "/planning/");
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
        } else if (strpos($previous, 'online')) {
            setcookie('kunder', '', time() + (86400), "/planning/");
            SetCookie('online', 'active', time() + (86400), "/planning/");
        }
//        header("location:" . $previous);
    } else {
//        header("location:../../taskForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} catch (phpmailerException $pme) {
    echo $pme->getMessage();
}


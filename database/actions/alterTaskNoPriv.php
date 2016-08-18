<?php

require_once '../DBConnection.php';
$session_expiration = time() + 3600 * 24; // +1 days
session_set_cookie_params($session_expiration);
session_start();

function htmlEntities2($str) {
    $text = str_replace("oe", "Ø", $str);
    $text = str_replace("aaa", "Å", $text);
    $text = str_replace("ae", "Æ", $text);
//    window.alert(text);
    return $text;
}

try {
    $user = $_SESSION["user"]->a_username;
    $id = $_COOKIE["Task"];
    $cus = $_POST["cus"];
    $stat = $_POST["stat"];
    $timespen = $_POST["hour"] . ":" . $_POST["min"];
    $comment = $_POST["newComment"];
    $press = isset($_POST['press']) && $_POST['press'] ? "true" : "false";
    $online = isset($_POST['online']) && $_POST['online'] ? "true" : "false";
    $db = new DBConnection();
    $q = "call altertasknopriv(:id, :stat, :timespent, :press, :online)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':id' => $id, ':stat' => $stat, ':timespent' => $timespen, ':press' => $press, ':online' => $online));
//    $count = $stmt->rowCount();
//    $commentcount = 0;
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
            sendmail($mails, $user->a_email, 'Ny kommentar på en opgave', 'Kunde: ' . $cus . '<br><br>Opgave: ' . $title . '<br><br>' . $user . ' har tilføjet en kommentar:<br>' . $comment);
        }
    }
    if ($stmt != FALSE) {
        setcookie('Kunde', $cus, time() + (86400), "/planning/");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
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
        } else if (strpos($previous, 'online')) {
            setcookie('kunder', '', time() + (86400), "/planning/");
            SetCookie('online', 'active', time() + (86400), "/planning/");
        }
        header("location:" . $previous);
    } else {
        header("location:../../taskForm.php?edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
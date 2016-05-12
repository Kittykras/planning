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
//    window.alert(text);
    return $text;
}

try {
    $user = $_SESSION["user"]->a_username;
    $cus = htmlEntities2($_COOKIE["Kunde"]);
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
    $tasktomain = $_COOKIE['Task'];
    $db = new DBConnection();
    $q = "call createtask(:cus, :title, :descr, :stat, :assi, :timespent, :pressdate, :press, :online, :t_tasktomain);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':cus' => $cus, ':title' => $title,
        ':descr' => $descr, ':stat' => $stat, ':assi' => $assi, ':timespent' => $timespen, ':pressdate' => $pressdate, ':press' => $press, ':online' => $online, ':t_tasktomain' => $tasktomain));
    $count = $stmt->rowCount();
    $q = "call setmainprojektstateonnew()";
    $stmt = $db->prepare($q);
    $stmt->execute();
    if ($comment != "") {
        $q = "call createcommentonnewtask(:comment, :user);";
        $stmt = $db->prepare($q);
        $stmt->execute(array(':comment' => $comment, ":user" => $user));
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
    if ($count > 0) {
        header("location:" . $_COOKIE['previous']);
    } else {
        header("location:../../taskForm.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} catch (phpmailerException $pme) {
    echo $pme->getMessage();
}



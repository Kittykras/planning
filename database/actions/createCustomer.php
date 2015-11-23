<?php

require_once '../DBConnection.php';

try {
    $name = $_POST["name"];
    $acro = $_POST["acro"];
    $cont = $_POST["cont"];
    $tlf = $_POST["tlf"];
    $mail = $_POST["mail"];
    $bran = $_POST["bran"];
    $assi = $_POST["assi"];
    $db = new DBConnection();
    $q = "call createcustomer(:acro, :name, :bran, :cont, :tlf, :mail, :assi);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':acro' => $acro, ':name' => $name, ':bran' => $bran, ':cont' => $cont, ':tlf' => $tlf, ':mail' => $mail, ':assi' => $assi));
    $count = $stmt->rowCount();
//    echo $urls[0].' '.$urls[1];
    if (isset($_POST["urls"])) {
        $urls = $_POST["urls"];
        $links = array();

        class url {

            public $id;
            public $url;
            public $user;
            public $pwd;

        }

        foreach ($urls as $link) {
            $temp = split('\¤', $link);
            $obj = new url();
            $obj->id = $temp[0];
            $obj->url = $temp[1];
            $obj->user = $temp[2];
            $obj->pwd = $temp[3];
            array_push($links, $obj);
        }
        foreach ($links as $link) {
            $q = "call createdisti(:id, :url, :user, :pwd, :acro)";
            $stmt = $db->prepare($q);
            $stmt->execute(array(':id' => $link->id, ':url' => $link->url, ':user' => $link->user, ':pwd' => $link->pwd, ':acro' => $acro));
        }
    }
    if ($count == 1) {
        SetCookie('medarbejder', '', time() + (86400), "/planning/");
        SetCookie('kunder', 'active', time() + (86400), "/planning/");
        SetCookie('overblik', '', time() + (86400), "/planning/");
        SetCookie('timeoversigt', '', time() + (86400), "/planning/");
        SetCookie('presse', '', time() + (86400), "/planning/");
        setcookie('login', '', time() + (86400), "/planning/");
        setcookie('orderby', 'c_name', time() + (86400), "/planning/");
        setcookie('state', '0', time() + (86400), "/planning/");
        header("location:".$_COOKIE['previous']);
    } else {
        header("location:../../customerForm.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
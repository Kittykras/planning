<?php

require_once '../DBConnection.php';

try {
    $oldCus = $_COOKIE["Kunde"];
    $name = $_POST["name"];
    $acro = $_POST["acro"];
    $cont = $_POST["cont"];
    $tlf = $_POST["tlf"];
    $mail = $_POST["mail"];
    $bran = $_POST["bran"];
    $assi = $_POST["assi"];
    $db = new DBConnection();
    $q = "call altercustomer(:oldCus, :acro, :name, :bran, :cont, :tlf, :mail, :assi);";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':oldCus' => $oldCus, ':acro' => $acro, ':name' => $name, ':bran' => $bran, ':cont' => $cont, ':tlf' => $tlf, ':mail' => $mail, ':assi' => $assi));
    $count = $stmt->rowCount();
    var_dump(isset($_POST["urls"]));
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
    if ($stmt != FALSE) {
        header("location:../../customers.php");
    } else {
        header("location:../../customerForm.php?editing=edit&error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
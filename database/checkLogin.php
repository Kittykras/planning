<?php
require_once 'DBConnection.php';
try {
    $username = $_POST["user"];
    $pass = $_POST["pwd"];
    $db = new DBConnection();
//    $username = stripslashes($username);
//    $pass = stripslashes($pass);
//    $username = mysql_real_escape_string($username);
//    $pass = mysql_real_escape_string($pass);
//    $q = "select * from vonbulowplanning. where username = :username and pass = :pass";
    $q = "call logon(:username,:pass)";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':username' => $username, ':pass' => $pass));
    $result = $stmt->fetch(PDO::FETCH_OBJ);
//    $result=  mysql_query($q);
    $count = $stmt->rowCount();
    if($count == 1){
        session_start();
        $_SESSION["user"] = $result->a_name;
        header("location:src/overblik.php");
        $db->close();
    }else {
        header("location:src/index.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


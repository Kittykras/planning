<?php
include 'DBConnection.php';
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
    
//    $result=  mysql_query($q);
    $count = $stmt->rowCount();
    if($count == 1){
        $_SESSION["user"] = $username;
        $_SESSION["pass"] = $pass;
        header("location:overblik.php");
    }else {
        header("location:index.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<?php
include 'DBConnection.php';
try {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $db = new DBConnection();
//    $username = stripslashes($username);
//    $pass = stripslashes($pass);
//    $username = mysql_real_escape_string($username);
//    $pass = mysql_real_escape_string($pass);
    $q = "select * from sunddb.users where username = :username and pass = :pass";
    $stmt = $db->prepare($q);
    $stmt->execute(array(':username' => $username, ':pass' => $pass));
    
//    $result=  mysql_query($q);
    $count = $stmt->rowCount();
    if($count == 1){
        $_SESSION["user"] = $username;
        $_SESSION["pass"] = $pass;
        header("location:home.php");
    }else {
        header("location:index.php?error");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<!-- Redirect user to login page if the user has been logged out -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION['user']) {
    header('Location: index.php');
    die;
}

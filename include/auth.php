<?php
session_start();

function checkAuth() {
    if( $_SESSION["user_is_logged_in"] != true) {
        header("Location: login.php");
        exit;
    }
}
?>

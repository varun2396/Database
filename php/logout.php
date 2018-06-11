<?php
session_start();
if (isset($_SESSION['user'])) {
    session_destroy();
    session_regenerate_id();
    echo 'hello';
    header("location:../login.php");
}
?>
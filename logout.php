<?php
    session_start();
    $_SESSION["login"]="false";
    session_unset();
    session_destroy();
    header("location:losi.php");

?>
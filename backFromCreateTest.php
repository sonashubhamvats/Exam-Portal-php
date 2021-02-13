<?php
    session_start();
    $con = mysqli_connect("127.0.0.1:3307","root","");
    mysqli_select_db($con,"examdb");
    $tableStatusName=$_SESSION["username"]."TestStatusHead";
    $delQuery="delete from ".$tableStatusName." where testcode='".$_SESSION["testcode"]."'";
    if (mysqli_query($con, $delQuery)) {
        $_SESSION["testname"]="null";
        $_SESSION["testcode"]="null";
        header("location:createTest.php");
    } else {
        echo "Error: ". mysqli_error($con);
    }
?>
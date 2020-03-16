<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    $target = $_GET['index'];
    mysqli_query($dbcon,"DELETE from antik WHERE idantik='$target'");
    echo "<script>alert('Berjaya menghapus maklumat antik.')</script>";
    echo '<script>window.location.href = "../checkstock/";</script>';
?>
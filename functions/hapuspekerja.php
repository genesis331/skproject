<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    require("./permcheck.php");
    $target = $_GET['index'];
    $dbquery = mysqli_query($dbcon,"DELETE from pekerja WHERE idpekerja='$target'");
    echo "<script>alert('Berjaya menghapus maklumat pekerja.')</script>";
    echo '<script>window.location.href = "../edituser/";</script>';
?>
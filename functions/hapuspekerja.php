<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    require("./permcheck.php");
    $target = $_GET['index'];
    $cmd = mysqli_query($dbcon,"DELETE from pekerja WHERE idpekerja='$target'");
    if ($cmd) {
        echo "<script>alert('Berjaya menghapus maklumat pekerja.')</script>";
        echo '<script>window.location.href = "../kemaskinipekerja/";</script>';
    } else {
        echo "<script>alert('Gagal menghapus maklumat pekerja.')</script>";
        echo '<script>window.location.href = "../kemaskinipekerja/";</script>';
    }
?>
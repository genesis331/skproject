<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    require("./permcheck.php");
    $target = $_GET['index'];
    $cmd = mysqli_query($dbcon,"DELETE from pembeli WHERE idpembeli='$target'");
    if ($cmd) {
        echo "<script>alert('Berjaya menghapus maklumat pembeli.')</script>";
        echo '<script>window.location.href = "../semakpembeli/";</script>';
    } else {
        echo "<script>alert('Gagal menghapus maklumat pembeli.')</script>";
        echo '<script>window.location.href = "../semakpembeli/";</script>';
    }
?>
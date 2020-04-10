<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    $target = $_GET['index'];
    // Dapat ID Antik dan masuk ke dalam SQL query lalu laksana DELETE untuk hapus rekod antik.
    $cmd = mysqli_query($dbcon,"DELETE from antik WHERE idantik='$target'");
    if ($cmd) {
        echo "<script>alert('Berjaya menghapus maklumat antik.')</script>";
        echo '<script>window.location.href = "../semakstok/";</script>';
    } else {
        echo "<script>alert('Gagal menghapus maklumat antik.')</script>";
        echo '<script>window.location.href = "../semakstok/";</script>';
    }
?>
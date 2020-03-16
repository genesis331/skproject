<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    require("./permcheck.php");
    $target = $_GET['index'];
    $dbquery = mysqli_query($dbcon,"DELETE from pembeli WHERE idpembeli='$target'");
    echo "<script>alert('Berjaya menghapus maklumat pembeli.')</script>";
    echo '<script>window.location.href = "../semakpembeli/";</script>';
?>
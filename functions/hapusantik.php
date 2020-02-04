<?php
    session_start();
    require("./authcheck.php");
    $target = $_GET['index'];

    mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"DELETE from antik WHERE idantik='$target'");
    echo "<script>alert('Berjaya menghapus maklumat antik.')</script>";
    echo '<script>window.location.href = "../checkstock/";</script>';
?>
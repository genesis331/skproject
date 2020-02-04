<?php
    session_start();
    require("./authcheck.php");
    require("../functions/permcheck.php");
    $target = $_GET['index'];
    $dbquery = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"DELETE from pekerja WHERE idpekerja='$target'");
    echo "<script>alert('Berjaya menghapus maklumat pekerja.')</script>";
    echo '<script>window.location.href = "../edituser/";</script>';
?>
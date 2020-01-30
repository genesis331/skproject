<?php
    session_start();
    require("./authcheck.php");
    $target = $_GET['index'];
    echo $target;

    $dbquery = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"DELETE from pekerja WHERE idpekerja='$target'");
    header("Location: ../edituser");
?>
<?php
    session_start();
    require("./authcheck.php");
    $target = $_GET['index'];

    mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"DELETE from antik WHERE idantik='$target'");
    header("Location: ../checkstock");
?>
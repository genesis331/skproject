<?php
    Global $dbcon;
    error_reporting(0);
    $dbcon = mysqli_connect("localhost","root","","antiquadb");
    // Jika gagal sambung ke pangkalan data, tunjuk mesej errornya.
    if (mysqli_connect_error()) {
        echo "<script>window.alert('Gagal sambung ke pangkalan data.')</script>";
    }
?>
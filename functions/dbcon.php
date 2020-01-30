<?php
    Global $dbcon;
    $dbcon = mysqli_connect("localhost","root","","antiquadb");
    if (mysqli_connect_error()) {
        echo "Gagal sambung ke pangkalan data dengan error" . mysqli_connect_error();
    }
?>
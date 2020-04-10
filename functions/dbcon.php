<?php
    Global $dbcon;
    $dbcon = mysqli_connect("localhost","root","","antiquadb");
    // Jika gagal sambung ke pangkalan data, tunjuk mesej errornya.
    if (mysqli_connect_error()) {
        echo "Gagal sambung ke pangkalan data dengan error" . mysqli_connect_error();
    }
?>
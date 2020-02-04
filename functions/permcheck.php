<?php
    if (isset($_SESSION['idpekerja'])) {
        $sessionid = $_SESSION['idpekerja'];
        $query = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "SELECT * FROM pekerja WHERE idpekerja='$sessionid'");
        $info = mysqli_fetch_array($query);
        if (!$info['status']) {
            echo "<script>alert('Hanya admin boleh mengakses laman ini.');</script>";
            echo '<script>window.location.href = "../main/";</script>';
        }
    }
?>
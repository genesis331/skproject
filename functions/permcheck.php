<?php
    require('../functions/dbcon.php');
    if (isset($_SESSION['idpekerja'])) {
        $sessionid = $_SESSION['idpekerja'];
        $query = mysqli_query($dbcon, "SELECT * FROM pekerja WHERE idpekerja='$sessionid'");
        $info = mysqli_fetch_array($query);
        if (!$info['status']) {
            echo "<script>alert('Hanya admin boleh mengakses laman ini.');</script>";
            echo '<script>window.location.href = "../main/";</script>';
        }
    }
?>
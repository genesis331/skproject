<?php
    session_start();
    require("./authcheck.php");
    if(isset($_FILES['datafile'])) {
        $filename = $_FILES['datafile']['tmp_name'];
        if ($_FILES['datafile']['size'] > 0) {
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                $tempid = "B";
                for($i = 0; $i < 5; $i++) {
                    $tempnum = rand(0,9);
                    $tempid = $tempid . $tempnum;
                }
                $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "INSERT INTO pembeli values ('$tempid','".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')");
            }
            echo "<script>alert('Berjaya mengimport maklumat pembeli.')</script>";
            echo '<script>window.location.href = "../addbuyer/";</script>';
        }
    }
?>
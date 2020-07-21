<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    require("./permcheck.php");
    // Dapat .csv fail data melalui $_SESSION lalu laksana INSERT bagi setiap rekod yang didapati dalam fail tersebut.
    if(isset($_SESSION['csvImport'])) {
        $csvArray = $_SESSION['csvImport'];
        $promiseAllCount = count($csvArray);
        $promiseStatus = array();
        for($counter = 0; $counter < count($csvArray); $counter++){
            $data = explode("|",$csvArray[$counter]);
            $tempid = "W";
            for($i = 0; $i < 5; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $cmd = mysqli_query($dbcon, "INSERT INTO pekerja values ('$tempid','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')");
            if ($cmd) {
                array_push($promiseStatus, true);
            } else {
                array_push($promiseStatus, false);
            }
        }
        while(count($promiseStatus) == $promiseAllCount) {
            if ($promiseStatus) {
                echo "<script>alert('Berjaya mengimport maklumat pekerja.')</script>";
                echo '<script>window.location.href = "../tambahpekerja/";</script>';
            } else {
                echo "<script>alert('Gagal mengimport maklumat pekerja.')</script>";
                echo '<script>window.location.href = "../tambahpekerja/";</script>';
            }
            break;
        }
    }
?>
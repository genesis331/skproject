<?php
    session_start();
    require('./dbcon.php');
    require("./authcheck.php");
    // Dapat .csv fail data melalui $_SESSION lalu laksana INSERT bagi setiap rekod yang didapati dalam fail tersebut.
    if(isset($_SESSION['csvImport'])) {
        $csvArray = $_SESSION['csvImport'];
        $promiseAllCount = count($csvArray);
        $promiseStatus = array();
        for($counter = 0; $counter < count($csvArray); $counter++){
            for($counter2 = 0; $counter2 < count($csvArray[0]); $counter2++){
                $data = explode("|",strval($csvArray[$counter][$counter2]));
                $tempid = "B";
                for($i = 0; $i < 5; $i++) {
                    $tempnum = rand(0,9);
                    $tempid = $tempid . $tempnum;
                }
                $cmd1 = mysqli_query($dbcon, "INSERT INTO alamat values ('".$data[3]."','".$data[6]."','".$data[5]."','".$data[4]."')");
                $cmd2 = mysqli_query($dbcon, "INSERT INTO pembeli values ('$tempid','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')");
                if ($cmd1 && $cmd2) {
                    array_push($promiseStatus, true);
                } else {
                    array_push($promiseStatus, false);
                }
            }
        }
        while(count($promiseStatus) == $promiseAllCount) {
            if ($promiseStatus) {
                echo "<script>alert('Berjaya mengimport maklumat pembeli.')</script>";
                echo '<script>window.location.href = "../tambahpembeli/";</script>';
            } else {
                echo "<script>alert('Gagal mengimport maklumat pembeli.')</script>";
                echo '<script>window.location.href = "../tambahpembeli/";</script>';
            }
            break;
        }
    }
?>
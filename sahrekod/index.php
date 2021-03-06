<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    // Jika butang 'submit' telah ditekan, tambah data ke dalam pangkalan data berdasarkan data baru dengan laksana INSERT.
    if (isset($_POST['submit'])) {
        // Jana ID yang unik kepada rekod jualan sebagai kunci primer.
        function generateID() {
            global $dbcon;
            $tempid = "R";
            for($i = 0; $i < 5; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query($dbcon, "SELECT * FROM jualan WHERE idjualan='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                return $tempid;
            }
        }
        // Tambah data ke dalam pangkalan data.
        function insertDB() {
            global $dbcon;
            $date = $_GET['tarikh'];
            $pembeli = $_GET['pembeli'];
            $penjual = $_SESSION['idpekerja'];
            $antik = explode(',',$_GET['antik']);
            $sum = 0;
            for($i = 0; $i <= count($antik) - 1; $i++) {
                $target = $antik[$i];
                $data = mysqli_query($dbcon,"SELECT * FROM antik WHERE idantik='$target'");
                $output = mysqli_fetch_array($data);
                $sum = $sum + $output['hargaantik'];
            }
            $tempid = generateID();
            $cmd = mysqli_query($dbcon, "INSERT INTO jualan values ('$tempid','$sum','$date','$pembeli','$penjual')");
            for($a = 0; $a <= count($antik) - 1; $a++) {
                mysqli_query($dbcon, "INSERT INTO rekod values (NULL,'$tempid','$antik[$a]')");
                // Tetap status antik kepada 0 supaya barang antik tersebut tidak boleh dibeli lagi.
                $data1 = mysqli_query($dbcon,"UPDATE antik SET status='0' WHERE idantik='$antik[$a]'");
            }
            if ($cmd) {
                echo "<script>alert('Berjaya menambah tempahan baru ke dalam sistem.')</script>";
                echo '<script>window.location.href = "../tambahrekod";</script>';
            } else {
                echo "<script>alert('Gagal menambah tempahan baru ke dalam sistem.')</script>";
                echo '<script>window.location.href = "../tambahrekod";</script>';
            }
        }
        insertDB();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem Pengurusan Jualan Antik Antiqua</title>
        <link rel="icon" href="../assets/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/sahrekod.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Pengesahan Jualan
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>TARIKH JUALAN</th>
                            <th>BARANG ANTIK</th>
                            <th>HARGA BARANG</th>
                            <th>NAMA PEMBELI</th>
                            <th>NAMA PEKERJA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $_GET['tarikh']?>
                            </td>
                            <td>
                                <?php
                                    $antik = explode(',',$_GET['antik']);
                                    for($i = 0; $i <= count($antik) - 1; $i++) {
                                        $target = $antik[$i];
                                        $data = mysqli_query($dbcon,"SELECT * FROM antik WHERE idantik='$target'");
                                        $output = mysqli_fetch_array($data);
                                        $index = $i + 1;
                                        echo "$index. " . $output['namaantik'] . " (" . $output['idantik'] . ")" . "<br>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $antik = explode(',',$_GET['antik']);
                                    for($i = 0; $i <= count($antik) - 1; $i++) {
                                        $target = $antik[$i];
                                        $data = mysqli_query($dbcon,"SELECT * FROM antik WHERE idantik='$target'");
                                        $output = mysqli_fetch_array($data);
                                        echo "RM " . $output['hargaantik'] . "<br>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $target = $_GET['pembeli'];
                                    $data = mysqli_query($dbcon,"SELECT * FROM pembeli WHERE idpembeli='$target'");
                                    $output = mysqli_fetch_array($data);
                                    echo $output['namapembeli'];
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $target = $_SESSION['idpekerja'];
                                    $data = mysqli_query($dbcon,"SELECT * FROM pekerja WHERE idpekerja='$target'");
                                    $output = mysqli_fetch_array($data);
                                    echo $output['namapekerja'];
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="confirm-sec">
                <div class="jumlah-sec">
                    Jumlah Bayaran: 
                    <span>
                        <?php
                            // Cari jumlah harga barang antik yang telah dipilih.
                            $sum = 0;
                            $antik = explode(',',$_GET['antik']);
                            for($i = 0; $i <= count($antik) - 1; $i++) {
                                $target = $antik[$i];
                                $data = mysqli_query($dbcon,"SELECT * FROM antik WHERE idantik='$target'");
                                $output = mysqli_fetch_array($data);
                                $sum = $sum + $output['hargaantik'];
                            }
                            echo "RM " . $sum;
                        ?>
                    </span>
                </div>
                <form method="POST" class="submit-form">
                    <div class="submit-sec">
                        <button class="zi-btn confirm-btn success" name="submit" onclick="return confirm('Tambah rekod baru ke dalam sistem?');">TAMBAH REKOD</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
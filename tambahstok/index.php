<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    // Jika butang 'submit' telah ditekan, tambah data ke dalam pangkalan data berdasarkan data baru dengan laksana INSERT.
    if (isset($_POST['namaantik'])) {
        function generateID($nama,$harga,$tempatasal,$deskripsi) {
            global $dbcon;
            // Jana ID yang unik kepada rekod jualan sebagai kunci primer.
            $tempid = "A";
            for($i = 0; $i < 8; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query($dbcon, "SELECT * FROM antik WHERE idantik='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                $cmd1 = mysqli_query($dbcon, "INSERT INTO antik values ('$tempid','$nama','$harga','$deskripsi','$tempatasal','1')");
                if ($cmd1) {
                    echo "<script>alert('Berjaya menambah maklumat antik baru ke dalam sistem.')</script>";
                    echo '<script>window.location.href = "./";</script>';
                } else {
                    echo "<script>alert('Gagal menambah maklumat antik baru ke dalam sistem.')</script>";
                    echo '<script>window.location.href = "./";</script>';
                }
            }
        }
        generateID($_POST['namaantik'],$_POST['hargaantik'],$_POST['tempatasal'],$_POST['deskripsi']);
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
        <link rel="stylesheet" href="../style/tambahstok.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Tambah Stok
        </div>
        <div class="addstock-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Nama Antik" name="namaantik" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Harga Antik" name="hargaantik" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Tempat Asal" name="tempatasal" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Deskripsi" name="deskripsi" required>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn" onclick="return confirm('Tambah maklumat stok baru ke dalam sistem?');">TAMBAH DATA</button>
                </div>
            </form>
        </div>
        <div class="importbtn-sec">
            atau <button class="zi-btn importbtn" onclick="getInputFile();">IMPORT DATA</button>
            <form method="POST" action="../paparimportstok/index.php" enctype="multipart/form-data">
                <input class="file-input" id="file-input" type="file" name="datafile" onchange="this.form.submit();">
            </form>
        </div>
        <script>
            function getInputFile() {
                document.getElementById("file-input").click();
            }
        </script>
    </body>
</html>
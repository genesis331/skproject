<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    $target = $_GET['index'];
    $data = mysqli_query($dbcon, "SELECT * FROM antik WHERE idantik='$target'");
    $info = mysqli_fetch_array($data);

    // Jika butang 'submit' telah ditekan, kemaskini data dalam pangkalan data berdasarkan data baru dengan laksana UPDATE.
    if (isset($_POST['update'])) {
        $nama = $_POST['namaantik'];
        $harga = $_POST['hargaantik'];
        $tempatasal = $_POST['tempatasal'];
        $penjelasan = $_POST['deskripsi'];
        $cmd = mysqli_query($dbcon,"UPDATE antik SET namaantik='$nama',hargaantik='$harga',tempatasalantik='$tempatasal',penjelasanantik='$penjelasan' WHERE idantik='$target'");
        if ($cmd) {
            echo "<script>alert('Berjaya mengemaskini maklumat antik.')</script>";
            echo '<script>window.location.href = "../semakstok/";</script>';
        } else {
            echo "<script>alert('Gagal mengemaskini maklumat antik.')</script>";
            echo '<script>window.location.href = "../semakstok/";</script>';
        }
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
            Kemaskini Barang
        </div>
        <div class="addstock-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Nama Antik" name="namaantik" required value="<?php echo $info['namaantik']?>">
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Harga Antik" name="hargaantik" required value="<?php echo $info['hargaantik']?>">
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Tempat Asal" name="tempatasal" required value="<?php echo $info['tempatasalantik']?>">
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Deskripsi" name="deskripsi" required value="<?php echo $info['penjelasanantik']?>">
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn" name="update" onclick="return confirm('Kemaskini maklumat stok dalam sistem?');">KEMASKINI DATA</button>
                </div>
            </form>
        </div>
    </body>
</html>
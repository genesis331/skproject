<?php
    require('../functions/dbcon.php');
    session_start();
    require("../functions/authcheck.php");
    $target = $_GET['index'];
    $data = mysqli_query($dbcon, "SELECT * FROM antik WHERE idantik='$target'");
    $info = mysqli_fetch_array($data);

    if (isset($_POST['update'])) {
        $nama = $_POST['namaantik'];
        $harga = $_POST['hargaantik'];
        $tempatasal = $_POST['tempatasal'];
        $penjelasan = $_POST['deskripsi'];
        $dbquery = mysqli_query($dbcon,"UPDATE antik SET namaantik='$nama',hargaantik='$harga',tempatasalantik='$tempatasal',penjelasanantik='$penjelasan' WHERE idantik='$target'");
        header("Location: ../checkstock");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem Pengurusan Jualan Antik Antiqua</title>
        <link rel="icon" href="../node_modules/@zeit-ui/style/dist/assets/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../node_modules/@zeit-ui/style/dist/style.css">
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/addstock.css">
    </head>
    <body class="zi-main zi-dark-theme">
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
                    <button class="zi-btn success submitbtn" name="update">KEMASKINI DATA</button>
                </div>
            </form>
        </div>
    </body>
</html>
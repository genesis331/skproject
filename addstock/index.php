<?php 
    session_start();
    include ("../functions/authcheck.php");
    if (isset($_POST['namaantik'])) {
        function generateID($nama,$harga,$tempatasal,$deskripsi) {
            $tempid = "A";
            for($i = 0; $i < 8; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "SELECT * FROM antik WHERE idantik='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "INSERT INTO antik (idantik,namaantik,hargaantik,penjelasanantik,tempatasalantik) values ('$tempid','$nama','$harga','$deskripsi', '$tempatasal')");
                header("Location: ./");
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
            Tambah Stok
        </div>
        <div class="addstock-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Nama Antik" name="namaantik" required>
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Harga Antik" name="hargaantik" required>
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Tempat Asal" name="tempatasal" required>
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Deskripsi" name="deskripsi" required>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn">TAMBAH DATA</button>
                </div>
            </form>
        </div>
    </body>
</html>
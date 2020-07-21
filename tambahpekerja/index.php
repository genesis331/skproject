<?php
    session_start();
    require('../functions/dbcon.php');
    // Jika butang 'submit' telah ditekan, tambah data ke dalam pangkalan data berdasarkan data baru dengan laksana INSERT.
    if (isset($_POST['namapekerja'])) {
        function generateID($nama,$notelefon,$katalaluan) {
            global $dbcon;
            // Jana ID yang unik kepada rekod jualan sebagai kunci primer.
            $tempid = "W";
            for($i = 0; $i < 5; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query($dbcon, "SELECT * FROM pekerja WHERE idpekerja='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                $jenis = number_format($_POST['user-type']);
                $cmd = mysqli_query($dbcon, "INSERT INTO pekerja values ('$tempid','$nama','$notelefon','$katalaluan','$jenis')");
                if ($cmd) {
                    echo "<script>alert('Berjaya menambah maklumat pekerja baru ke dalam sistem.')</script>";
                    echo '<script>window.location.href = "./";</script>';
                } else {
                    echo "<script>alert('Gagal menambah maklumat pekerja baru ke dalam sistem.')</script>";
                    echo '<script>window.location.href = "./";</script>';
                }
            }
        }
        generateID($_POST['namapekerja'],$_POST['notelefonpekerja'],$_POST['katalaluan']);
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
        <link rel="stylesheet" href="../style/tambahpekerja.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Tambah Pekerja
        </div>
        <div class="adduser-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Nama Pekerja" name="namapekerja" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Nombor Telefon Pekerja" name="notelefonpekerja" required type="tel" minlength="10" maxlength="12">
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Kata Laluan Akaun Pekerja" name="katalaluan" required minlength="8" maxlength="30">
                    </div>
                    <br><br>
                    <label>Jenis pekerja:</label>
                    <div class="zi-select-container">
                        <select class="zi-select" id="user-type-selection" name="user-type">
                            <option value="0">PEKERJA</option>
                            <option value="1">ADMIN</option>
                        </select>
                        <i class="arrow zi-icon-chevron-down"></i>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn" onclick="return confirm('Tambah maklumat pekerja baru ke dalam sistem?');">
                        TAMBAH DATA
                    </button>
                </div>
            </form>
        </div>
        <div class="importbtn-sec">
            atau <button class="zi-btn importbtn" onclick="getInputFile();">IMPORT DATA</button>
            <form method="POST" action="../paparimportpekerja/index.php" enctype="multipart/form-data">
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
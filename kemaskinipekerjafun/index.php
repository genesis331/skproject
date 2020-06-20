<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    require("../functions/permcheck.php");
    $target = $_GET['index'];
    $data = mysqli_query($dbcon, "SELECT * FROM pekerja WHERE idpekerja='$target'");
    $info = mysqli_fetch_array($data);

    // Jika butang 'submit' telah ditekan, kemaskini data dalam pangkalan data berdasarkan data baru dengan laksana UPDATE.
    if (isset($_POST['update'])) {
        $nama = $_POST['namapekerja'];
        $notelefon = $_POST['notelefonpekerja'];
        $katalaluan = $_POST['katalaluan'];
        $jenis = number_format($_POST['user-type']);
        $cmd = mysqli_query($dbcon,"UPDATE pekerja SET namapekerja='$nama',notelefonpekerja='$notelefon',katalaluanpekerja='$katalaluan',status='$jenis' WHERE idpekerja='$target'");
        if ($cmd) {
            echo "<script>alert('Berjaya mengemaskini maklumat pekerja.')</script>";
            echo '<script>window.location.href = "../kemaskinipekerja/";</script>';
        } else {
            echo "<script>alert('Gagal mengemaskini maklumat pekerja.')</script>";
            echo '<script>window.location.href = "../kemaskinipekerja/";</script>';
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
        <link rel="stylesheet" href="../style/tambahpekerja.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Kemaskini Pekerja
        </div>
        <div class="adduser-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Nama Pekerja" name="namapekerja" required value="<?php echo $info['namapekerja'];?>">
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Nombor Telefon Pekerja" name="notelefonpekerja" required type="tel" value="<?php echo $info['notelefonpekerja'];?>">
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Kata Laluan Akaun Pekerja" name="katalaluan" required value="<?php echo $info['katalaluanpekerja'];?>">
                    </div>
                    <br><br>
                    <label>Jenis pekerja:</label>
                    <div class="zi-select-container">
                        <select class="zi-select" id="user-type-selection" name="user-type">
                            <option <?php if ($info['status'] == 1 ) echo 'selected';?> value="1">ADMIN</option>
                            <option <?php if ($info['status'] == 0 ) echo 'selected';?> value="0">PEKERJA</option>
                        </select>
                        <i class="arrow zi-icon-up"></i>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn" name="update" onclick="return confirm('Kemaskini maklumat pekerja dalam sistem?');">KEMASKINI DATA</button>
                </div>
            </form>
        </div>
    </body>
</html>
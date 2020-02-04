<?php
    require('../functions/dbcon.php');
    session_start();
    require("../functions/authcheck.php");
    $target = $_GET['index'];
    $data = mysqli_query($dbcon, "SELECT * FROM pekerja WHERE idpekerja='$target'");
    $info = mysqli_fetch_array($data);

    if (isset($_POST['update'])) {
        $nama = $_POST['namapekerja'];
        $notelefon = $_POST['notelefonpekerja'];
        $katalaluan = $_POST['katalaluan'];
        $dbquery = mysqli_query($dbcon,"UPDATE pekerja SET namapekerja='$nama',notelefonpekerja='$notelefon',katalaluanpekerja='$katalaluan' WHERE idpekerja='$target'");
        echo "<script>alert('Berjaya mengemaskini maklumat pekerja.')</script>";
        echo '<script>window.location.href = "../edituser/";</script>';
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
        <link rel="stylesheet" href="../style/adduser.css">
    </head>
    <body class="zi-main zi-dark-theme">
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
                </div>
                <div>
                    <button class="zi-btn success submitbtn" name="update">KEMASKINI DATA</button>
                </div>
            </form>
        </div>
    </body>
</html>
<?php
    session_start();
    include ("../functions/authcheck.php");
    if (isset($_POST['namapekerja'])) {
        function generateID($nama,$notelefon,$katalaluan) {
            $tempid = "W";
            for($i = 0; $i < 5; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "SELECT * FROM pekerja WHERE idpekerja='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "INSERT INTO pekerja (idpekerja,namapekerja,notelefonpekerja,katalaluanpekerja) values ('$tempid','$nama','$notelefon','$katalaluan')");
                header("Location: ./");
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
        <link rel="icon" href="../node_modules/@zeit-ui/style/dist/assets/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../node_modules/@zeit-ui/style/dist/style.css">
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/adduser.css">
    </head>
    <body class="zi-main zi-dark-theme">
        <?php include("../components/header.php");?>
        <div class="title">
            Tambah Pekerja
        </div>
        <div class="adduser-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Nama Pekerja" name="namapekerja" required>
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Nombor Telefon Pekerja" name="notelefonpekerja" required type="tel">
                    </div>
                    <br>
                    <div class="zi-input-group prefix">
                        <input class="zi-input" placeholder="Kata Laluan Akaun Pekerja" name="katalaluan" required>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn">TAMBAH DATA</button>
                </div>
            </form>
        </div>
        <div class="importbtn-sec">
            atau <button class="zi-btn importbtn">IMPORT DATA</button>
        </div>
    </body>
</html>
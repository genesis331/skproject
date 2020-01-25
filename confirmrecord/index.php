<?php 
    session_start();
    include ("../functions/authcheck.php");
    if (isset($_POST['submit'])) {
        function generateID() {
            $tempid = "R";
            for($i = 0; $i < 5; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "SELECT * FROM jualan WHERE idjualan='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                return $tempid;
            }
        }
        function insertDB() {
            $date = $_GET['tarikh'];
            $pembeli = $_GET['pembeli'];
            $penjual = $_SESSION['idpekerja'];
            $antik = explode(',',$_GET['antik']);
            for($a = 0; $a <= count($antik) - 1; $a++) {
                $target = $antik[$a];
                $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM antik WHERE idantik='$target'");
                $output = mysqli_fetch_array($data);
                $harga = $output['hargaantik'];
                $tempid = generateID();
                mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "INSERT INTO jualan (idjualan,jumlahjualan,tarikhjualan,idpembeli,idpekerja,idantik) values ('$tempid','$harga','$date','$pembeli','$penjual','$antik[$a]')");
                $data1 = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"UPDATE antik SET status='0' WHERE idantik='$antik[$a]'");
            }
            header("Location: ../addrecord");
        }
        insertDB();
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
        <link rel="stylesheet" href="../style/confirmrecord.css">
    </head>
    <body class="zi-main zi-dark-theme">
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
                                        $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM antik WHERE idantik='$target'");
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
                                        $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM antik WHERE idantik='$target'");
                                        $output = mysqli_fetch_array($data);
                                        echo "RM " . $output['hargaantik'] . "<br>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $target = $_GET['pembeli'];
                                    $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM pembeli WHERE idpembeli='$target'");
                                    $output = mysqli_fetch_array($data);
                                    echo $output['namapembeli'];
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $target = $_SESSION['idpekerja'];
                                    $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM pekerja WHERE idpekerja='$target'");
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
                            $sum = 0;
                            $antik = explode(',',$_GET['antik']);
                            for($i = 0; $i <= count($antik) - 1; $i++) {
                                $target = $antik[$i];
                                $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM antik WHERE idantik='$target'");
                                $output = mysqli_fetch_array($data);
                                $sum = $sum + $output['hargaantik'];
                            }
                            echo "RM " . $sum;
                        ?>
                    </span>
                </div>
                <form method="POST" class="submit-form">
                    <div class="submit-sec">
                        <button class="zi-btn confirm-btn success" name="submit">TAMBAH REKOD</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
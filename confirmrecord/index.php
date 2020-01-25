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
            // $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "SELECT * FROM pekerja WHERE idpekerja='$tempid'");
            // if (mysqli_num_rows($result)) {
            //     generateID();
            // } else {
            //     $result = mysqli_query(mysqli_connect("localhost","root","","antiquadb"), "INSERT INTO pekerja (idpekerja,namapekerja,notelefonpekerja,katalaluanpekerja) values ('$tempid','$nama','$notelefon','$katalaluan')");
            //     header("Location: ./");
            // }
        }
        // generateID();
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
                                // $sum = 0;
                                $antik = explode(',',$_GET['antik']);
                                for($i = 0; $i <= count($antik) - 1; $i++) {
                                    $target = $antik[$i];
                                    $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM antik WHERE idantik='$target'");
                                    $output = mysqli_fetch_array($data);
                                    echo "RM " . $output['hargaantik'] . "<br>";
                                    // $sum = $sum + intval($output['hargaantik']);
                                }
                                // echo "RM " . $sum;
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
        </div>
    </body>
</html>
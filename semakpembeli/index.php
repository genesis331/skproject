<?php 
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
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
        <link rel="stylesheet" href="../style/semakstok.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Semak Pembeli
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>NAME PEMBELI</th>
                            <th>ID PEMBELI</th>
                            <th>NO KAD IC</th>
                            <th>NO TELEFON</th>
                            <th>ALAMAT</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Dapat data dari pangkalan data dan tunjuk data dalam 'table'.
                            $data = mysqli_query($dbcon,"SELECT * FROM pembeli JOIN alamat"); 
                            $no = 1;
                            while ($info = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?php echo $info['namapembeli'];?></td>
                            <td><?php echo $info['idpembeli'];?></td>
                            <td><?php echo $info['nokadicpembeli'];?></td>
                            <td><?php echo $info['notelefonpembeli'];?></td>
                            <td><?php echo $info['alamat'] . ", " . $info['bandar'] . ", " . $info['poskod'] . ", " . $info['negeri'];?></td>
                            <td>
                                <a href="../functions/hapuspembeli.php?index=<?php echo $info['idpembeli'];?>">
                                    <button class="zi-btn action-btn" onclick="return confirm('Hapus maklumat pembeli dari sistem?');"><i class="prefix zi-icon-trash"></i>HAPUS</button>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="extra-btn">
                    <a href="../tambahpembeli/"><button class="zi-btn add-buyer-btn"><i class="prefix zi-icon-plus"></i>Tambah Pembeli</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
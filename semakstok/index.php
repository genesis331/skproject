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
            Semak Stok
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>NAME ANTIK</th>
                            <th>ID ANTIK</th>
                            <th>HARGA ANTIK</th>
                            <th>DESKRIPSI</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Dapat data dari pangkalan data dan tunjuk data dalam 'table'.
                            $data = mysqli_query($dbcon,"SELECT * FROM antik"); 
                            $no = 1;
                            while ($info = mysqli_fetch_array($data)) {
                                if ($info['status']) {
                        ?>
                        <tr>
                            <td><?php echo $info['namaantik'];?></td>
                            <td><?php echo $info['idantik'];?></td>
                            <td><?php echo 'RM '.$info['hargaantik'];?></td>
                            <td><?php echo $info['penjelasanantik'];?></td>
                            <td>
                                <a href="../kemaskinistokfun/index.php?index=<?php echo $info['idantik'];?>">
                                    <button class="zi-btn action-btn"><i class="prefix zi-icon-edit-2"></i>KEMASKINI</button>
                                </a>
                                <a href="../functions/hapusantik.php?index=<?php echo $info['idantik'];?>" onclick="return confirm('Hapus maklumat stok dari sistem?');">
                                    <button class="zi-btn action-btn"><i class="prefix zi-icon-trash"></i>HAPUS</button>
                                </a>
                            </td>
                        </tr>
                        <?php }}?>
                    </tbody>
                </table>
                <div class="extra-btn">
                    <a href="../tambahstok/"><button class="zi-btn add-buyer-btn"><i class="prefix zi-icon-plus"></i>Tambah Stok</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
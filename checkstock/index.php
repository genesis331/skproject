<?php 
    require('../functions/dbcon.php');
    session_start();
    require("../functions/authcheck.php");
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
        <link rel="stylesheet" href="../style/checkstock.css">
    </head>
    <body class="zi-main zi-dark-theme">
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
                            $data = mysqli_query($dbcon,"SELECT * FROM antik"); 
                            $no = 1;
                            while ($info = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?php echo $info['namaantik'];?></td>
                            <td><?php echo $info['idantik'];?></td>
                            <td><?php echo $info['hargaantik'];?></td>
                            <th><?php echo $info['penjelasanantik'];?></th>
                            <td>
                                <a href="../editstockfun/index.php?index=<?php echo $info['idantik'];?>">
                                    <button class="zi-btn action-btn">KEMASKINI</button>
                                </a>
                                <a href="../functions/hapusantik.php?index=<?php echo $info['idantik'];?>">
                                    <button class="zi-btn action-btn">HAPUS</button>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
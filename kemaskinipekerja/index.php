<?php 
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    require("../functions/permcheck.php");
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
        <link rel="stylesheet" href="../style/kemaskinipekerja.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Kemaskini Pekerja
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>NAME PEKERJA</th>
                            <th>NO TELEFON PEKERJA</th>
                            <th>JENIS PEKERJA</th>
                            <th>KATA LALUAN</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Dapat data dari pangkalan data dan tunjuk data dalam 'table'.
                            $data = mysqli_query($dbcon,"SELECT * FROM pekerja"); 
                            while ($info = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?php echo $info['namapekerja'];?></td>
                            <td><?php echo $info['notelefonpekerja'];?></td>
                            <td>
                                <?php 
                                    if ($info['status'] == 1) {
                                        echo 'ADMIN';
                                    } else {
                                        echo 'PEKERJA';
                                    }
                                ?>
                            </td>
                            <td><?php echo $info['katalaluanpekerja'];?></td>
                            <td>
                                <a href="../kemaskinipekerjafun/index.php?index=<?php echo $info['idpekerja'];?>">
                                    <button class="zi-btn action-btn"><i class="prefix zi-icon-edit-2"></i>KEMASKINI</button>
                                </a>
                                <a href="../functions/hapuspekerja.php?index=<?php echo $info['idpekerja'];?>" onclick="return confirm('Hapus maklumat pekerja dari sistem?');">
                                    <button class="zi-btn action-btn"><i class="prefix zi-icon-trash"></i>HAPUS</button>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="extra-btn">
                    <a href="../tambahpekerja/"><button class="zi-btn add-buyer-btn"><i class="prefix zi-icon-plus"></i>Tambah Pekerja</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
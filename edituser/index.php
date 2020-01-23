<?php 
    session_start();
    include ("../functions/authcheck.php");
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
        <link rel="stylesheet" href="../style/edituser.css">
    </head>
    <body class="zi-main zi-dark-theme">
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
                        <th>KATA LALUAN</th>
                        <th>TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM pekerja"); 
                        $no = 0;
                        while ($info = mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php echo $info['namapekerja'];?></td>
                        <td><?php echo $info['notelefonpekerja'];?></td>
                        <td><?php echo $info['katalaluanpekerja'];?></td>
                        <td><a href="../edituserfun/index.php?index=<?php echo $info['idpekerja'];?>"><button class="zi-btn action-btn">KEMASKINI</button></a><a href="../functions/hapuspekerja.php?index=<?php echo $info['idpekerja'];?>"><button class="zi-btn action-btn">HAPUS</button></a></td>
                    </tr>
                    <?php $no++; }?>
                </tbody>
            </table>
            </div>
        </div>
        <script>
            function editTarget(target) {
                console.log(target);
            }
        </script>
    </body>
</html>
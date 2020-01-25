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
        <link rel="stylesheet" href="../style/showrecord.css">
    </head>
    <body class="zi-main zi-dark-theme">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title2">
            <div class="title-display-sec">
                Papar Jualan
            </div>
            <div class="title-select-sec">
                <span class="title-select-sec-title">
                    Bulan Jualan
                </span>
                <div class="zi-select-container">
                    <select class="zi-select">
                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Mac</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Jun</option>
                        <option>Julai</option>
                        <option>Ogos</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Disember</option>
                    </select>
                    <i class="arrow zi-icon-up"></i>
                </div>
            </div>
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>ID JUALAN</th>
                            <th>NAMA PEMBELI</th>
                            <th>AMAUN DIBAYAR</th>
                            <th>TARIKH JUALAN</th>
                            <th>NAMA PENJUAL</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
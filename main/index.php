<?php 
    session_start();
    include ("../functions/authcheck.php");
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
        <link rel="stylesheet" href="../style/main.css">
    </head>
    <body class="zi-main">
        <?php $headerOpenStatus=true; include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="main-content">
            <div class="indi">
                <i class="zi-icon-home" style="font-size: 3rem"></i>
                <br/>
                Sila pilih laman yang dikehendaki dari menu sistem.
            </div>
        </div>
    </body>
</html>
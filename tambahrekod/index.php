<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    error_reporting(0);
    if (isset($_POST['submit'])) {
        $antikselect = "";
        for($i = 0; $i < 5; $i++) {
            if ($_POST['antik-selection'.$i]) {
                if ($i == 0) {
                    $antikselect = $antikselect . $_POST['antik-selection'.$i];
                } else {
                    $antikselect = $antikselect . "," . $_POST['antik-selection'.$i];
                }
            }
        }
        $idpembeli = $_POST['pembeli'];
        $tarikhjualan = $_POST['tarikhjualan'];
        header("Location: ../sahrekod/index.php?antik=$antikselect" . "&pembeli=$idpembeli" . "&tarikh=$tarikhjualan");
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
        <link rel="stylesheet" href="../style/tambahrekod.css">
    </head>
    <body class="zi-main zi-dark-theme">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Rekod Jualan
        </div>
        <div class="addrecord-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div id="item-selection-sec">
                        <div class="zi-select-container">
                            <select class="zi-select" id="antik-selection" name="antik-selection0">
                                <?php
                                    $data = mysqli_query($dbcon,"SELECT * FROM antik");
                                    while ($info = mysqli_fetch_array($data)) {
                                        if ($info['status'] != 0) {
                                ?>
                                <option value="<?php echo $info['idantik'];?>"><?php echo $info['namaantik'];?></option>
                                <?php }}?>
                            </select>
                            <i class="arrow zi-icon-up"></i>
                        </div>
                    </div>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Tarikh Jualan" name="tarikhjualan" required type="date" value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <br>
                    <div class="zi-select-container">
                        <select class="zi-select" name="pembeli" id="buyer-selection">
                            <?php
                                $data = mysqli_query($dbcon,"SELECT * FROM pembeli");
                                while ($info = mysqli_fetch_array($data)) {
                            ?>
                            <option value="<?php echo $info['idpembeli'];?>"><?php echo $info['namapembeli'];?></option>
                            <?php }?>
                        </select>
                        <i class="arrow zi-icon-up"></i>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn" name="submit">TAMBAH DATA</button>
                </div>
            </form>
            <div class="extra-btn">
                <button class="zi-btn add-buyer-btn" onclick="appendInput();">Tambah Belian</button>
                <a href="../tambahpembeli/"><button class="zi-btn add-buyer-btn">Tambah Pembeli</button></a>
            </div>
        </div>
        <script>
            let appendIndex = 1;
            function appendInput() {
                if (appendIndex < 4) {
                    let elem = document.createElement('div');
                    elem.className = "zi-select-container";
                    let elem2 = document.createElement('select');
                    elem2.className = "zi-select";
                    elem2.id = "antik-selection";
                    elem2.name = "antik-selection" + appendIndex;
                    appendIndex++;
                    elem.appendChild(elem2);
                    let elem3 = document.createElement('i');
                    elem3.className = "arrow zi-icon-up";
                    elem.appendChild(elem3);
                    for (let i = 0; i <= document.getElementById('antik-selection').length - 1; i++) {
                        let elem4 = document.createElement('option');
                        elem4.value = document.getElementById('antik-selection').options[i].value;
                        elem4.innerHTML = document.getElementById('antik-selection').options[i].text;
                        elem2.appendChild(elem4);
                    }
                    document.getElementById('item-selection-sec').appendChild(elem);
                }
            }
        </script>
    </body>
</html>
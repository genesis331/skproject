<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    error_reporting(0);
    // Jika butang 'submit' telah ditekan, redirect ke laman sah rekod jualan.
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
        <link rel="icon" href="../assets/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/global.css">
        <link rel="stylesheet" href="../style/tambahrekod.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Rekod Jualan
        </div>
        <div class="addrecord-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div id="item-selection-sec">
                        <div class="zi-select-container" id="select0">
                            <select class="zi-select select-dropdown" id="antik-selection" name="antik-selection0" onchange="updateOptions();">
                                <?php
                                    $data = mysqli_query($dbcon,"SELECT * FROM antik");
                                    while ($info = mysqli_fetch_array($data)) {
                                        if ($info['status'] != 0) {
                                ?>
                                <option value="<?php echo $info['idantik'];?>"><?php echo $info['namaantik'];?></option>
                                <?php }}?>
                            </select>
                            <i class="arrow zi-icon-chevron-down"></i>
                        </div>
                    </div>
                    <button class="zi-btn add-item-btn" id="add-item-btn" onclick="appendInput(); return false;"><i class="zi-icon-plus"></i></button>
                    <button class="zi-btn disabled remove-item-btn" id="remove-item-btn" onclick="removeInput(); return false;"><i class="zi-icon-minus"></i></button>
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
                        <i class="arrow zi-icon-chevron-down"></i>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn" name="submit"><i class="prefix zi-icon-plus"></i>TAMBAH DATA</button>
                </div>
            </form>
            <div class="extra-btn">
                <a href="../tambahpembeli/"><button class="zi-btn"><i class="prefix zi-icon-plus"></i>Tambah Pembeli</button></a>
            </div>
        </div>
        <script>
            let appendIndex = 1;
            let dropdownElems = document.getElementsByClassName('select-dropdown');
            let selectedIndices = [];

            function appendInput() {
                if (appendIndex < 4 && appendIndex < dropdownElems[0].options.length) {
                    let elem = document.createElement('div');
                    elem.className = "zi-select-container";
                    elem.id="select" + appendIndex;
                    let elem2 = document.createElement('select');
                    elem2.className = "zi-select select-dropdown";
                    elem2.id = "antik-selection";
                    elem2.name = "antik-selection" + appendIndex;
                    elem2.setAttribute("onchange","updateOptions();");
                    appendIndex++;
                    if (appendIndex > 3 || appendIndex > dropdownElems[0].options.length - 1) {
                        let btnElem = document.getElementById('add-item-btn');
                        btnElem.classList.add('disabled');
                    } else {
                        let btnElem = document.getElementById('remove-item-btn');
                        btnElem.classList.remove('disabled');
                    }
                    elem.appendChild(elem2);
                    let elem3 = document.createElement('i');
                    elem3.className = "arrow zi-icon-chevron-down";
                    elem.appendChild(elem3);
                    for (let i = 0; i <= document.getElementById('antik-selection').length - 1; i++) {
                        let elem4 = document.createElement('option');
                        elem4.value = document.getElementById('antik-selection').options[i].value;
                        elem4.innerHTML = document.getElementById('antik-selection').options[i].text;
                        elem2.appendChild(elem4);
                    }
                    for (let ii = 0; ii <= dropdownElems[0].options.length; ii++) {
                        if (!selectedIndices.includes(ii)) {
                            elem2.options.selectedIndex = ii;
                            break;
                        }
                    }
                    document.getElementById('item-selection-sec').appendChild(elem);
                    updateOptions();
                }
            }

            function removeInput() {
                if (appendIndex > 1) {
                    let elem = document.getElementById('select' + (appendIndex - 1));
                    elem.remove();
                    appendIndex--;
                    if (appendIndex < 2) {
                        let btnElem = document.getElementById('remove-item-btn');
                        btnElem.classList.add('disabled');
                    } else {
                        let btnElem = document.getElementById('add-item-btn');
                        btnElem.classList.remove('disabled');
                    }
                    updateOptions();
                }
            }

            function updateOptions() {
                selectedIndices = [];
                for (let i = 0; i <= dropdownElems.length - 1; i++) {
                    for (let a = 0; a <= dropdownElems[i].options.length - 1; a++) {
                        dropdownElems[i].options[a].disabled = false;
                    } 
                    selectedIndices.push(dropdownElems[i].options.selectedIndex);
                }
                for (let ii = 0; ii <= dropdownElems.length - 1; ii++) {
                    for (let b = 0; b <= selectedIndices.length - 1; b++) {
                        if (b !== ii) {
                            dropdownElems[ii].options[selectedIndices[b]].disabled = true;
                        }
                    }
                }
            }

            window.onload = function(){updateOptions();}
        </script>
    </body>
</html>
<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
    error_reporting(0);
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
        <link rel="stylesheet" href="../style/paparjualan.css">
    </head>
    <body class="zi-main zi-dark-theme">
        <script>
            let jualandata;
            let pekerjadata;
            let pembelidata;
        </script>
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
                <form method="POST" class="form-sec">
                <div class="zi-select-container">
                    <select class="zi-select" name="month-selection" id="month-selection" onChange="updateDisplay(jualandata,pekerjadata,pembelidata,antikdata,rekoddata);">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Mac</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Jun</option>
                        <option value="07">Julai</option>
                        <option value="08">Ogos</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Disember</option>
                    </select>
                    <i class="arrow zi-icon-up"></i>
                </div>
                </form>
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
                            <th>BARANG DIBELI</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <script>
                            function updateDisplay(data,data1,data2,data3,data4) {
                                document.getElementById('tbody').innerHTML = "";
                                jualandata = data;
                                pekerjadata = data1;
                                pembelidata = data2;
                                antikdata = data3;
                                rekoddata = data4;
                                var outputItems = "";
                                for (let i = 0; i <= data.length - 1; i++) {
                                    if (parseInt(data[i]['tarikhjualan'].split('-')[1]) == parseInt(document.getElementById('month-selection').value)) {
                                        let elem = document.createElement('tr');
                                        elem1 = document.createElement('td');
                                        elem1.innerHTML = data[i]['idjualan'];
                                        elem.appendChild(elem1);
                                        elem2 = document.createElement('td');
                                        for (let iii = 0; iii <= data2.length - 1; iii++) {
                                            if (data2[iii]['idpembeli'] == data[i]['idpembeli']) {
                                                elem2.innerHTML = data2[iii]['namapembeli'];
                                            }
                                        }
                                        elem.appendChild(elem2);
                                        elem3 = document.createElement('td');
                                        elem3.innerHTML = "RM " + data[i]['jumlahjualan'];
                                        elem.appendChild(elem3);
                                        elem4 = document.createElement('td');
                                        elem4.innerHTML = data[i]['tarikhjualan'];
                                        elem.appendChild(elem4);
                                        elem5 = document.createElement('td');
                                        for (let ii = 0; ii <= data1.length - 1; ii++) {
                                            if (data1[ii]['idpekerja'] == data[i]['idpekerja']) {
                                                elem5.innerHTML = data1[ii]['namapekerja'];
                                            }
                                        }
                                        elem.appendChild(elem5);
                                        elem6 = document.createElement('td');
                                        for (let v = 0; v <= data4.length - 1; v++) {
                                            if (data4[v]['idjualan'] == data[i]['idjualan']) {
                                                for (let vi = 0; vi <= data4.length - 1; vi++) {
                                                    if (data4[v]['idantik'] == data3[vi]['idantik']) {
                                                        outputItems += data3[vi]['namaantik'] + "<br/>";
                                                    }
                                                }
                                                elem6.innerHTML = outputItems;
                                            }
                                        }
                                        outputItems = "";
                                        elem.appendChild(elem6);
                                        document.getElementById('tbody').appendChild(elem);
                                    }
                                }
                            }
                        </script>
                        <?php
                            $data = mysqli_query($dbcon,"SELECT * FROM jualan");
                            while ($info = mysqli_fetch_array($data)) {
                                $result[] = $info;
                            }
                            $data1 = mysqli_query($dbcon,"SELECT * FROM pekerja");
                            while ($info1 = mysqli_fetch_array($data1)) {
                                $result1[] = $info1;
                            }
                            $data2 = mysqli_query($dbcon,"SELECT * FROM pembeli");
                            while ($info2 = mysqli_fetch_array($data2)) {
                                $result2[] = $info2;
                            }
                            $data3 = mysqli_query($dbcon,"SELECT * FROM antik");
                            while ($info3 = mysqli_fetch_array($data3)) {
                                $result3[] = $info3;
                            }
                            $data4 = mysqli_query($dbcon,"SELECT * FROM rekod");
                            while ($info4 = mysqli_fetch_array($data4)) {
                                $result4[] = $info4;
                            }
                            $jsdata = json_encode($result);
                            $jsdata1 = json_encode($result1);
                            $jsdata2 = json_encode($result2);
                            $jsdata3 = json_encode($result3);
                            $jsdata4 = json_encode($result4);
                            echo "<script>updateDisplay($jsdata,$jsdata1,$jsdata2,$jsdata3,$jsdata4)</script>";
                        ?>
                    </tbody>
                </table>
                <div class="print-btn-sec">
                    <script>
                        function jumpToPrint() {
                            let target = document.getElementById('month-selection').value;
                            window.open("../cetakjualan?targetmonth=" + target); 
                        }
                    </script>
                    <button class="zi-btn action-btn" onclick="jumpToPrint();">CETAK</button>
                </div>
            </div>
        </div>
    </body>
</html>
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
        <script>
            let jualandata;
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
                    <select class="zi-select" name="month-selection" id="month-selection" onChange="updateDisplay(jualandata);">
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
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <script>
                            function updateDisplay(data) {
                                document.getElementById('tbody').innerHTML = "";
                                jualandata = data;
                                for (let i = 0; i <= data.length - 1; i++) {
                                    if (parseInt(data[i]['tarikhjualan'].split('-')[1]) == parseInt(document.getElementById('month-selection').value)) {
                                        let elem = document.createElement('tr');
                                        elem1 = document.createElement('td');
                                        elem1.innerHTML = data[i]['idjualan'];
                                        elem.appendChild(elem1);
                                        elem2 = document.createElement('td');
                                        elem2.innerHTML = data[i]['idpembeli'];
                                        elem.appendChild(elem2);
                                        elem3 = document.createElement('td');
                                        elem3.innerHTML = data[i]['jumlahjualan'];
                                        elem.appendChild(elem3);
                                        elem4 = document.createElement('td');
                                        elem4.innerHTML = data[i]['tarikhjualan'];
                                        elem.appendChild(elem4);
                                        elem5 = document.createElement('td');
                                        elem5.innerHTML = data[i]['idpekerja'];
                                        elem.appendChild(elem5);
                                        elem6 = document.createElement('td');
                                        elem.appendChild(elem6);
                                        document.getElementById('tbody').appendChild(elem);
                                    }
                                }
                            }
                        </script>
                        <?php
                            $data = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM jualan");
                            while ($info = mysqli_fetch_array($data)) {
                                $result[] = $info;
                            }
                            $jsdata = json_encode($result);
                            echo "<script>updateDisplay($jsdata)</script>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
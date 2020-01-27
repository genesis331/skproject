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
        <link rel="stylesheet" href="../style/printrecord.css">
    </head>
    <body class="zi-main">
        <script>
            let jualandata;
            let pekerjadata;
            let pembelidata;
        </script>
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title2">
            <div class="title-display-sec">
                LAPORAN BULANAN SISTEM PENGURUSAN JUALAN ANTIK ANTIQUA - 
                <span>
                    <?php
                        switch($_GET['targetmonth']) {
                            case "01" : echo "JANUARI"; break;
                            case "02" : echo "FEBRUARI"; break;
                            case "03" : echo "MAC"; break;
                            case "04" : echo "APRIL"; break;
                            case "05" : echo "MEI"; break;
                            case "06" : echo "JUN"; break;
                            case "07" : echo "JULAI"; break;
                            case "08" : echo "OGOS"; break;
                            case "09" : echo "SEPTEMBER"; break;
                            case "10" : echo "OKTOBER"; break;
                            case "11" : echo "NOVEMBER"; break;
                            case "12" : echo "DISEMBER"; break;
                        } 
                    ?>
                </span>
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
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <script>
                            function updateDisplay(data,data1,data2) {
                                document.getElementById('tbody').innerHTML = "";
                                jualandata = data;
                                pekerjadata = data1;
                                pembelidata = data2;
                                for (let i = 0; i <= data.length - 1; i++) {
                                    if (parseInt(data[i]['tarikhjualan'].split('-')[1]) == parseInt(<?php echo $_GET['targetmonth']?>)) {
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
                            $data1 = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM pekerja");
                            while ($info1 = mysqli_fetch_array($data1)) {
                                $result1[] = $info1;
                            }
                            $data2 = mysqli_query(mysqli_connect("localhost","root","","antiquadb"),"SELECT * FROM pembeli");
                            while ($info2 = mysqli_fetch_array($data2)) {
                                $result2[] = $info2;
                            }
                            $jsdata = json_encode($result);
                            $jsdata1 = json_encode($result1);
                            $jsdata2 = json_encode($result2);
                            echo "<script>updateDisplay($jsdata,$jsdata1,$jsdata2)</script>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    </body>
</html>
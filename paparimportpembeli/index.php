<?php
    session_start();
    require('../functions/dbcon.php');
    require("../functions/authcheck.php");
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
        <link rel="stylesheet" href="../style/paparimport.css">
    </head>
    <body class="zi-main">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title2">
            <div class="title-display-sec">
                Import Pembeli
            </div>
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>NO KAD IC PEMBELI</th>
                            <th>NO TELEFON PEMBELI</th>
                            <th>NAMA PEMBELI</th>
                            <th>ALAMAT</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                            // Dapat .csv fail dengan fgetcsv() lalu papar setiap rekod yang didapati dalam fail tersebut.
                            if(isset($_FILES['datafile'])) {
                                $filename = $_FILES['datafile']['tmp_name'];
                                if ($_FILES['datafile']['size'] > 0) {
                                    $file = fopen($filename, "r");
                                    $csvArray = array_map('str_getcsv', file($filename));
                                    array_shift($csvArray);
                                    $_SESSION['csvImport'] = $csvArray;
                                    for($counter = 0; $counter < count($csvArray); $counter++){
                                        echo('<tr>');
                                        for($counter2 = 0; $counter2 < count($csvArray[0]); $counter2++){
                                            $data = explode("|",strval($csvArray[$counter][$counter2]));
                                            $tempAlamat = '';
                                            for($counter3 = 0; $counter3 < count($data); $counter3++) {
                                                if ($counter3 >= 3) {
                                                    if ($counter3 > 3) {
                                                        $tempAlamat = $tempAlamat . ", " . $data[$counter3];
                                                    } else {
                                                        $tempAlamat = $data[$counter3];
                                                    }
                                                    if ($counter3 == 6) {
                                                        echo('<td>');
                                                        echo($tempAlamat);
                                                        echo('</td>');
                                                    }
                                                } else {
                                                    echo('<td>');
                                                    echo($data[$counter3]);
                                                    echo('</td>');
                                                }
                                            }
                                        }
                                        echo('</tr>');
                                    }
                                }
                            } 
                        ?>
                    </tbody>
                </table>
                <div class="print-btn-sec">
                    <form method="POST" action="../functions/importbuyer.php">
                        <button class="zi-btn action-btn">IMPORT</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
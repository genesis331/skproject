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
                Import Pekerja
            </div>
        </div>
        <div class="table-sec">
            <div class="table-container">
                <table class="zi-table data-table">
                    <thead>
                        <tr>
                            <th>NAMA PENGGUNA</th>
                            <th>NO TELEFON</th>
                            <th>KATA LALUAN</th>
                            <th>JENIS PENGGUNA</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php
                            // Dapat .csv fail dengan fgetcsv() lalu papar setiap rekod yang didapati dalam fail tersebut.
                            if(isset($_FILES['datafile'])) {
                                $filename = $_FILES['datafile']['tmp_name'];
                                if ($_FILES['datafile']['size'] > 0) {
                                    $file = fopen($filename, "r");
                                    $csvArray = str_getcsv(file_get_contents($filename),"\n");
                                    array_shift($csvArray);
                                    $_SESSION['csvImport'] = $csvArray;
                                    for($counter = 0; $counter < count($csvArray); $counter++){
                                        echo('<tr>');
                                        $data = explode("|",$csvArray[$counter]);
                                        for($counter2 = 0; $counter2 < count($data); $counter2++){
                                            echo('<td>');
                                            if ($counter2 == 3) {
                                                if ($data[$counter2] == 0) {
                                                    echo('PEKERJA');
                                                } else if ($data[$counter2] == 1) {
                                                    echo('ADMIN');
                                                }
                                            } else {
                                                echo($data[$counter2]);
                                            }
                                            echo('</td>');
                                        }
                                        echo('</tr>');
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <div class="print-btn-sec">
                    <form method="POST" action="../functions/importuser.php">
                        <button class="zi-btn action-btn"><i class="prefix zi-icon-upload"></i>IMPORT</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
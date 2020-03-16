<?php 
    require('../functions/dbcon.php');
    session_start();
    require("../functions/authcheck.php");
    if (isset($_POST['nama'])) {
        function generateID($nama,$nokadic,$notelefon,$alamat,$negeri,$bandar,$poskod) {
            global $dbcon;
            $tempid = "B";
            for($i = 0; $i < 5; $i++) {
                $tempnum = rand(0,9);
                $tempid = $tempid . $tempnum;
            }
            $result = mysqli_query($dbcon, "SELECT * FROM pembeli WHERE idpembeli='$tempid'");
            if (mysqli_num_rows($result)) {
                generateID();
            } else {
                mysqli_query($dbcon, "INSERT INTO alamat (alamat,negeri,poskod,bandar) values ('$alamat','$negeri','$poskod','$bandar')");
                mysqli_query($dbcon, "INSERT INTO pembeli (idpembeli,nokadicpembeli,notelefonpembeli,namapembeli,alamat) values ('$tempid','$nokadic','$notelefon','$nama','$alamat')");
                header("Location: ../addrecord");
            }
        }
        generateID($_POST['nama'],$_POST['nokadic'],$_POST['notelefon'],$_POST['alamat'],$_POST['negeri'],$_POST['bandar'],$_POST['poskod']);
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
        <link rel="stylesheet" href="../style/addbuyer.css">
    </head>
    <body class="zi-main zi-dark-theme">
        <?php include("../components/header.php");?>
        <?php include("../components/menuoverlay.php");?>
        <div class="title">
            Tambah Pembeli
        </div>
        <div class="addrecord-content">
            <form class="login-form" method="POST" autocomplete="off">
                <div>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Nama Pembeli" name="nama" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="No Kad IC Pembeli" name="nokadic" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="No Telefon Pembeli" name="notelefon" required>
                    </div>
                    <br>
                    <div class="zi-input-group">
                        <input class="zi-input" placeholder="Alamat Rumah" name="alamat" required>
                    </div>
                    <br>
                    <div class="zi-select-container">
                        <select class="zi-select" id="negeri-selection" name="negeri" onchange="updateBandar();">
                            <option value="PAHANG">PAHANG</option>
                            <option value="PERAK">PERAK</option>
                            <option value="TERENGGANU">TERENGGANU</option>
                            <option value="PERLIS">PERLIS</option>
                            <option value="SELANGOR">SELANGOR</option>
                            <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                            <option value="JOHOR">JOHOR</option>
                            <option value="KELANTAN">KELANTAN</option>
                            <option value="KEDAH">KEDAH</option>
                            <option value="PULAU PINANG">PULAU PINANG</option>
                            <option value="MELAKA">MELAKA</option>
                            <option value="SABAH">SABAH</option>
                            <option value="SARAWAK">SARAWAK</option>
                        </select>
                        <i class="arrow zi-icon-up"></i>
                    </div>
                    <div class="zi-select-container">
                        <select class="zi-select" name="bandar" id="bandar-selection"></select>
                        <i class="arrow zi-icon-up"></i>
                    </div>
                    <div class="zi-input-group address-input-group">
                        <input class="zi-input address-input" placeholder="Poskod" name="poskod" required>
                    </div>
                </div>
                <div>
                    <button class="zi-btn success submitbtn">TAMBAH DATA</button>
                </div>
            </form>
        </div>
        <div class="importbtn-sec">
            atau <button class="zi-btn importbtn" onclick="getInputFile();">IMPORT DATA</button>
            <form method="POST" action="../functions/importbuyer.php" enctype="multipart/form-data">
                <input class="file-input" id="file-input" type="file" name="datafile" onchange="this.form.submit();">
            </form>
        </div>
        <script>
            function getInputFile() {
                document.getElementById("file-input").click();
            }
        </script>
        <script>
            let pahang = ['KUANTAN','TEMERLOH','BENTONG','MENTAKAB','RAUB','JERANTUT','PEKAN','KUALA LIPIS','BANDAR JENGKA','BUKIT TINGGI'];
            let perak = ['IPOH','TAIPING','SITIAWAN','SIMPANG EMPAT','TELUK INTAN','BATU GAJAH','LUMUT','KAMPUNG KOH','KUALA KANGSAR','SUNGAI SIPUT','TAPAH','BIDOR','PARIT BUNTAR','AYER TAWAR','BAGAN SERAI','TANJUNG MALIM','LAWAN KUDA BAHARU','PANTAI REMIS','KAMPAR','KAMPUNG GAJAH'];
            let terengganu = ['KUALA TERENGGANU','CHUKAI','DUNGUN','KERTEH','KUALA BERANG','MARANG','PAKA','JERTEH'];
            let perlis = ['KANGAR','ARAU','PADANG BESAR'];
            let selangor = ['SUBANG JAYA','KLANG','AMPANG JAYA','SHAH ALAM','PETALING JAYA','CHERAS','KAJANG','SELAYANG','RAWANG','TAMAN GREENWOOD','SEMENYIH','BANTING','BALAKONG','GOMBAK SETIA','KUALA SELANGOR','SERENDAH','BUKIT BERUNTUNG','PENGKALAN KUNDANG','JENJAROM','SUNGAI BESAR','BATU ARANG','TANJUNG SEPAT','KUANG','KUALA KUBU BAHARU','BATANG BERJUNTAI','BANDAR BARU SALAK TINGGI','SEKINCHAN','SEBAK','TANJUNG KARANG','BERENANG','SUNGAI PELEK'];
            let negeri_sembilan = ['SEREMBAN','PORT DICKSON','NILAI','BAHAU','TAMPIN','KUALA PILAH'];
            let johor = ['JOHOR BAHRU','TEBRAU','PASIR GUDANG','BUKIT INDAH','SKUDAI','KLUANG','BATU PAHAT','MUAR','ULU TIRAM','SENAI','SEGAMAT','KULAI','KOTA TINGGI','PONTIAN KECHIL','TANGKAK','BUKIT BAKRI','YONG PENG','PEKAN NENAS','LABIS','MERSING','SIMPANG RENGGAM','PARIT RAJA','KELAPA SAWIT','BULOH KASAP','CHAAH'];
            let kelantan = ['KOTA BHARU','PENGKALAN KUBOR','TANAH MERAH','PERINGAT','WAKAF BHARU','KADOK','PASIR MAS','GUA MUSANG','KUALA KRAI','TUMPAT'];
            let kedah = ['SUNGAI PETANI','ALOR SETAR','KULIM','JITRA','BALING','PENDANG','LANGKAWI','YAN','SIK','KUALA NERANG','POKOK SENA','BANDAR BAHARU'];
            let pulau_pinang = ['BUKIT MERTAJAM','GEORGETOWN','SUNGAI ARA','GELUGOR','AIR ITAM','BUTTERWORTH','PERAI','NIBONG TEBAL','PERMATANG PAUH','TANJUNG TOKONG','KEPALA BATAS','TANJUNG BUNGAH','JURU'];
            let melaka = ['BANDARAYA MELAKA','BUKIT BARU','AYER KEROH','KLEBANG','MASJID TANAH','SUNGAI UDANG','BATU BERENDAM','ALOR GAJAH','BUKIT RAMBAI','AYER MOLEK','BEMBAN','KUALA SUNGAI BARU','PULAU SEBANG'];
            let sabah = ['KOTA KINABALU','SANDAKAN','TAWAU','LAHAD DATU','KENINGAU','PUTATAN','DONGGONGAN','SEMPORNA','KUDAT','KUNAK','PAPAR','RANAU','BEAUFORT','KINARUT','KOTA BELUD'];
            let sarawak = ['KUCHING','MIRI','SIBU','BINTULU','LIMBANG','SARIKEI','SRI AMAN','KAPIT','BATU DELAPAN BAZAAR','KOTA SAMARAHAN'];
            
            function updateBandar() {
                let target = document.getElementById('negeri-selection').value;
                let currentAppend;
                let optionparent = document.getElementById('bandar-selection');
                optionparent.innerHTML = "";

                if (target == 'PAHANG') {
                    currentAppend = pahang;
                } else if (target == 'PERAK') {
                    currentAppend = perak;
                } else if (target == 'TERENGGANU') {
                    currentAppend = terengganu;
                } else if (target == 'PERLIS') {
                    currentAppend = perlis;
                } else if (target == 'SELANGOR') {
                    currentAppend = selangor;
                } else if (target == 'NEGERI SEMBILAN') {
                    currentAppend = negeri_sembilan;
                } else if (target == 'JOHOR') {
                    currentAppend = johor;
                } else if (target == 'KELANTAN') {
                    currentAppend = kelantan;
                } else if (target == 'KEDAH') {
                    currentAppend = kedah;
                } else if (target == 'PULAU PINANG') {
                    currentAppend = pulau_pinang;
                } else if (target == 'MELAKA') {
                    currentAppend = melaka;
                } else if (target == 'SABAH') {
                    currentAppend = sabah;
                } else if (target == 'SARAWAK') {
                    currentAppend = sarawak;
                }

                for (let i = 0; i <= currentAppend.length - 1; i++) {
                    var opt = document.createElement('option');
                    opt.appendChild(document.createTextNode(currentAppend[i]));
                    opt.value = currentAppend[i]; 
                    optionparent.appendChild(opt);
                }
            }

            window.onload = function() {
                let optionparent = document.getElementById('bandar-selection');
                for (let i = 0; i <= pahang.length - 1; i++) {
                    var opt = document.createElement('option');
                    opt.appendChild(document.createTextNode(pahang[i]));
                    opt.value = pahang[i]; 
                    optionparent.appendChild(opt);
                }
            }
        </script>
    </body>
</html>
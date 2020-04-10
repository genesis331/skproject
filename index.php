<?php
    require('./functions/dbcon.php');
    session_start();
    if (isset($_POST['namapekerja'])) {
        $idpengguna = $_POST['namapekerja'];
        $katalaluanpengguna = $_POST['katalaluanpekerja'];

        $dbquery = mysqli_query($dbcon,"SELECT * FROM pekerja WHERE namapekerja='$idpengguna' AND katalaluanpekerja='$katalaluanpengguna'");
        $row = mysqli_fetch_assoc($dbquery);

        //Jika terdapatnya hasil daripada SQL query, redirect ke laman utama sistem dan menetap $_SESSION.
        if (mysqli_num_rows($dbquery) == 0 || $row['katalaluanpekerja'] != $katalaluanpengguna) {
            echo "<script>alert('ID pengguna atau kata laluan adalah salah.')</script>";
        } else {
            $_SESSION['idpekerja'] = $row['idpekerja'];
            $admin = $_SESSION['idpekerja'];
            header("Location: ./main");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log masuk ke Sistem Pengurusan Jualan Antik Antiqua</title>
        <meta name="description" content="">
        <link rel="icon" href="./node_modules/@zeit-ui/style/dist/assets/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./node_modules/@zeit-ui/style/dist/style.css">
        <link rel="stylesheet" href="./style/global.css">
        <link rel="stylesheet" href="./style/index.css">
    </head>
    <body class="zi-main zi-dark-theme">
        <div class="login-center">
            <h3>LOG MASUK</h3>
            <h2>Sistem Pengurusan Jualan Antik Antiqua</h2>
            <form class="login-form" method="POST">
                <div class="zi-input-group prefix">
                    <span class="zi-label prefix">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" shape-rendering="geometricPrecision" style="color:var(--geist-foreground)"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <input class="zi-input" placeholder="Nama Pengguna" name="namapekerja" required>
                </div>
                <br>
                <br>
                <div class="zi-input-group prefix">
                    <span class="zi-label prefix">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" shape-rendering="geometricPrecision" style="color:var(--geist-foreground)"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
                    </span>
                    <input class="zi-input" type="password" placeholder="Kata Laluan" name="katalaluanpekerja" required>
                </div>
                <div class="submitbtn-sec">
                    <button class="zi-btn success">LOG MASUK</button>
                </div>
            </form>
            <div class="register-sec">
                Pengguna baru? <a href="./tambahpekerja">Klik sini</a> untuk mendaftar.
            </div>
        </div>
    </body>
</html>
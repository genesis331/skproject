<?php 
    //Jika $_SESSION tidak ditetapkan, redirect pengguna ke laman log masuk.
    if (!(isset($_SESSION['idpekerja']))) {
        session_destroy();
        header("Location: ../");
    }
?>
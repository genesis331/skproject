<?php 
    if (!(isset($_SESSION['idpekerja']))) {
        session_destroy();
        header("Location: ./");
    }
?>
<?php 
    if (!(isset($_SESSION['idpengguna']))) {
        session_destroy();

        header("Location: /");
    }
?>
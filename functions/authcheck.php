<?php 
    if (!(isset($_SESSION['namapekerja']))) {
        session_destroy();
        header("Location: /");
    }
?>
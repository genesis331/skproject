<?php 
    session_start();
    //Musnah sesi pengguna dengan session_unset() dan session_destroy() lalu redirect ke laman log masuk.
    session_unset();
    session_destroy();
    header("Location: ../");
?>
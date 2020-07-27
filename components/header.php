<?php
    $bg = array(
      '../assets/images/box-1995679_1920.jpg',
      '../assets/images/journey-1130732_1920.jpg',
      '../assets/images/living-room-581073_1920.jpg',
      '../assets/images/old-1130731_1920.jpg',
      '../assets/images/old-1130742_1920.jpg',
      '../assets/images/old-1130743_1920.jpg',
      '../assets/images/old-books-436498_1920.jpg'
    );
    $i = rand(0, count($bg)-1);
    $selectedBg = "$bg[$i]";
?>
<style>
    body::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
        background-image: url(<?php echo $selectedBg?>);
        opacity: 0.5;
    }

    .header-sec {
        height: 7rem;
        width: 100%;
        display: grid;
        grid-template-columns: 60% 30% 10%;
        user-select: none;
        z-index: 9;
    }

    .header-sec1 img {
        height: 4.5rem;
        padding: 0 3rem;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    .header-sec2 {
        text-align: right;
    }

    .header-sec3 {
        text-align: right;
    }

    .zi-popover {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        margin-right: 4rem;
        z-index: 10;
    }

    .header-sec3 i {
        cursor: pointer;
    }

    .zi-popover-host {
        line-height: initial;
    }

    .zi-popover-host i {
        font-size: 1.8rem;
    }

    .zi-popover-item {
        width: auto;
    }

    .zi-popover-dropdown {
        transition: 0.2s;
        opacity: 0;
        pointer-events: none;
        display: initial;
    }

    .zi-popover-dropdown.active {
        transition: 0.2s;
        opacity: 1;
        pointer-events: initial;
    }

    .customization-op-sec {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    .customization-op-sec i {
        vertical-align: middle;
        font-size: 1.5rem;
    }

    .zi-toggle {
        vertical-align: middle;
        transition-timing-function: unset;
    }

    .zi-toggle::before {
        transition-timing-function: unset;
        transition-duration: unset;
    }
</style>
<script>
    let menuStatus = false;
    function toggleMenu() {
        if (menuStatus) {
            menuStatus = false;
            document.getElementById('zi-popover-dropdown').classList.remove('active');
            document.getElementById('menu-overlay').classList.remove('active');
        } else {
            menuStatus = true;
            document.getElementById('zi-popover-dropdown').classList.add('active');
            document.getElementById('menu-overlay').classList.add('active');
        }
    }

    let fontSizeCookie;
    let currentSize;
    function zoomIn() {
        document.getElementsByTagName('html')[0].style.fontSize = currentSize + 1 + "px";
        currentSize++;
        localStorage.setItem("antikFontSize", currentSize);
    }

    function zoomOut() {
        document.getElementsByTagName('html')[0].style.fontSize = currentSize - 1 + "px";
        currentSize--;
        localStorage.setItem("antikFontSize", currentSize);
    }

    let darkModeCookie;
    let currentDarkModeStatus;
    function toggleDarkMode() {
        if (currentDarkModeStatus) {
            currentDarkModeStatus = false;
            localStorage.setItem("antikDarkMode", false);
            document.getElementById('zi-toggle').classList.remove('checked');
            document.getElementsByTagName('body')[0].classList.remove('zi-dark-theme');
            document.getElementById('logo-img').src="../assets/LOGO-BLACK.svg";
        } else {
            currentDarkModeStatus = true;
            localStorage.setItem("antikDarkMode", true);
            document.getElementById('zi-toggle').classList.add('checked');
            document.getElementsByTagName('body')[0].classList.add('zi-dark-theme');
            document.getElementById('logo-img').src="../assets/LOGO-WHITE.svg";
        }
    }

    function confirmLogOut() {
        let prompt = window.confirm('Anda akan log keluar dari sistem.');
        if (prompt) {
            window.location.href = "../functions/logkeluar.php";
        }
    }

    window.onload = function() {
        fontSizeCookie = localStorage.getItem("antikFontSize");
        darkModeCookie = localStorage.getItem("antikDarkMode");
        if (!fontSizeCookie) {
            currentSize = 14;
            localStorage.setItem("antikFontSize", 14);
            document.getElementsByTagName('html')[0].style.fontSize = currentSize + "px";
        } else {
            currentSize = parseInt(fontSizeCookie);
            document.getElementsByTagName('html')[0].style.fontSize = currentSize + "px";
        }
        if (darkModeCookie == undefined || darkModeCookie == "false") {
            currentDarkModeStatus = false;
            localStorage.setItem("antikDarkMode", false);
        } else {
            currentDarkModeStatus = darkModeCookie;
            document.getElementById('zi-toggle').classList.add('checked');
            document.getElementsByTagName('body')[0].classList.add('zi-dark-theme');
            document.getElementById('logo-img').src="../assets/LOGO-WHITE.svg";
        }
    }
</script>
<div class="header-sec">
    <div class="header-sec1">
        <a href="../main/"><img id="logo-img" src="../assets/LOGO-BLACK.svg" draggable="false"/></a>
    </div>
    <div class="header-sec2">
        <div class="customization-op-sec">
            <i class="zi-icon-zoom-in" style="padding: 0.5rem 0.2rem 0.5rem 0.2rem; cursor: pointer;" onclick="zoomIn();"></i>
            <i class="zi-icon-zoom-out" style="padding: 0.5rem 0.2rem 0.5rem 0.2rem; cursor: pointer;" onclick="zoomOut();"></i>
            <i class="zi-icon-moon" style="padding: 0.5rem 0.2rem 0.5rem 1.5rem;"></i>
            <div class="zi-toggle" id="zi-toggle" onclick="toggleDarkMode();"></div>
        </div>
    </div>
    <div class="header-sec3">
        <div class="zi-popover">
            <div class="zi-popover-host" onclick="toggleMenu();">
                <i class="zi-icon-menu"></i>
            </div>
            <div class='<?php if($headerOpenStatus) {echo "zi-popover-dropdown right active";} else {echo "zi-popover-dropdown right";}; ?>' id="zi-popover-dropdown">
                <a href="../tambahpekerja/"><div class="zi-popover-item">Tambah Pekerja</div></a>
                <a href="../kemaskinipekerja/"><div class="zi-popover-item">Kemaskini Pekerja</div></a>
                <a href="../tambahstok/"><div class="zi-popover-item">Tambah Stok</div></a>
                <a href="../semakstok/"><div class="zi-popover-item">Semak Stok</div></a>
                <a href="../tambahrekod/"><div class="zi-popover-item">Rekod Jualan</div></a>
                <a href="../paparjualan/"><div class="zi-popover-item">Papar Jualan</div></a>
                <a href="../semakpembeli/"><div class="zi-popover-item">Semak Pembeli</div></a>
                <div onclick="confirmLogOut();" class="zi-popover-item" style="font-weight: 700">Log Keluar</div>
                <br/>
            </div>
        </div>
    </div>
    </div>
</div>
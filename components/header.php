<style>
    .header-sec {
        height: 7rem;
        width: 100%;
        display: grid;
        grid-template-columns: 80% 20%;
        user-select: none;
        z-index: 9;
    }

    .header-sec1 h3 {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        margin: 0;
        padding: 0 3rem;
        font-family: "Volte", sans-serif;
        font-size: 1.4rem;
    }

    .header-sec1 h3 a {
        text-decoration: none;
    }

    .header-sec2 {
        text-align: right;
    }

    .zi-popover {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        margin-right: 4rem;
        z-index: 10;
    }

    .header-sec2 img {
        height: 2rem;
        cursor: pointer;
    }

    .zi-popover-item {
        width: auto;
    }

    .zi-popover-dropdown {
        transition: 0.2s;
        opacity: 0;
        pointer-events: none;
    }

    .zi-popover-dropdown.active {
        transition: 0.2s;
        opacity: 1;
        pointer-events: initial;
    }
</style>
<script>
    let menuStatus = false;
    function toggleMenu() {
        if (menuStatus) {
            menuStatus = false;
            document.getElementById('zi-popover-dropdown').classList.remove('active');
        } else {
            menuStatus = true;
            document.getElementById('zi-popover-dropdown').classList.add('active');
        }
    }
</script>
<div class="header-sec">
    <div class="header-sec1">
        <h3><a href="../main/">Sistem Pengurusan Jualan Antik Antiqua</a></h3>
    </div>
    <div class="header-sec2">
        <div class="zi-popover">
            <span class="zi-popover-host" onclick="toggleMenu();">
                <img src="../assets/images/menu.svg">
            </span>
            <div class="zi-popover-dropdown right" id="zi-popover-dropdown">
                <a href="../adduser/"><div class="zi-popover-item">Tambah Pekerja</div></a>
                <a href="../edituser/"><div class="zi-popover-item">Kemaskini Pekerja</div></a>
                <a href="../checkstock/"><div class="zi-popover-item">Semak Stok</div></a>
                <a href="../addrecord/"><div class="zi-popover-item">Rekod Jualan</div></a>
                <a href="../showrecord/"><div class="zi-popover-item">Papar Jualan</div></a>
            </div>
        </div>
    </div>
    </div>
</div>
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
</style>
<div class="header-sec">
    <div class="header-sec1">
        <h3>Sistem Pengurusan Jualan Antik Antiqua</h3>
    </div>
    <div class="header-sec2">
        <div class="zi-popover">
            <span class="zi-popover-host">
                <img src="../assets/images/menu.svg">
            </span>
            <div class="zi-popover-dropdown right">
                <div class="zi-popover-item">Tambah Pekerja</div>
                <div class="zi-popover-item">Kemaskini Pekerja</div>
                <div class="zi-popover-item">Semak Stok</div>
                <div class="zi-popover-item">Rekod Jualan</div>
                <div class="zi-popover-item">Papar Jualan</div>
            </div>
        </div>
    </div>
    </div>
</div>
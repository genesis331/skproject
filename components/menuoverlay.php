<style>
    .menu-overlay {
        height: 100%;
        width: 100%;
        position: absolute;
        z-index: 8;
        top: 0;
        pointer-events: none;
    }

    .menu-overlay.active {
        pointer-events: initial;
    }
</style>
<div class="menu-overlay" id="menu-overlay" onclick="toggleMenu();"></div>
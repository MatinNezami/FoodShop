$.select("aside.menu", "menu");

function closeMenu () {
    $.menu.style.left = "-260px";
    $.body.style.overflow = "visible";
}

function openMenu () {
    $.menu.style.left = 0;
    $.body.style.overflow = "hidden";
}

$.select(".menu .close").event("click", closeMenu);
$.select("header nav .open").event("click", openMenu);
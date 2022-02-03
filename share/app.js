const headerMenu = document.querySelector("aside.menu");


function closeMenu () {
    headerMenu.style.left = "-260px";
    document.body.style.overflow = "visible";
}

function openMenu () {
    headerMenu.style.left = 0;
    document.body.style.overflow = "hidden";
}

document.querySelector(".menu .close").addEventListener("click", closeMenu);
document.querySelector("header nav .open").addEventListener("click", openMenu);
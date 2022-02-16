$.select("footer", "footer");
$.select("footer > img", "footerBackground");
$.footer.before = $.footer.select(".products-box");

function footerImage () {
    const src = window.innerWidth <= 1068? "/images/post3.webp": "/images/post2.webp";

    if ($.footerBackground?.getAttribute("src") == src)
        return null;

    $.footerBackground?.remove();
    delete $.footerBackground;

    const img = new Image();
    img.draggable = "false";
    img.alt = "background picture";
    img.src = src;

    $.footer.insertBefore(img, $.footer.before)

    $.select("footer > img", "footerBackground");
}

footerImage();

window.addEventListener("resize", footerImage);


$.select(".aside-product", "asideProducts");
$.select(".hide-product", "hideProducts");


function showProducts () {
    $[(window.innerWidth < 600? "hideProducts": "asideProducts")].forEach(elm => {
        const elmTop = elm.offsetParent.offsetTop + elm.parentNode.offsetTop + elm.offsetHeight / 2;

        if (window.scrollY + window.innerHeight / 2 >= elmTop)
            elm.classList.add("show");
    });
}

window.addEventListener("scroll", showProducts);
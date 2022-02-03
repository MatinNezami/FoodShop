const asideProducts = $.select(".aside-product");

function showProducts () {
    if (window.innerWidth <= 500)
        return null;

    asideProducts.forEach(elm => {
        const elmTop = elm.offsetParent.offsetTop + elm.parentNode.offsetTop + elm.offsetHeight / 2;

        if (window.scrollY + window.innerHeight / 2 >= elmTop)
            elm.classList.add("show");
    });
}

window.addEventListener("scroll", showProducts);
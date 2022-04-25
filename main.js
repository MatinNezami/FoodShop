// small code
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
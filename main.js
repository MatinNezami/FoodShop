$.select(".effects-box .product", "effect");

function animateProducts () {
    $.effect.forEach(box => {
        if (scrollY + innerHeight / 2 >= box.getBoundingClientRect().y + scrollY)
            box.classList.add("active");
    });
}

function magnet (event) {
    event.currentTarget.style.transition = "unset";

    const centerWidth = event.currentTarget.offsetWidth / 2,
        centerHeight = event.currentTarget.offsetHeight / 2,
        rotateY = `rotateY(${(centerWidth - event.layerX) / 10}deg)`,
        rotateX = `rotateX(${(centerHeight - event.layerY) / 10}deg)`;

    event.currentTarget.style.transform =  rotateX + rotateY;
}

const prevent = ev => ev.currentTarget.style.transform = "";
$.effect.forEach(box => box.event("pointermove", magnet, "pointerleave", prevent));

self.addEventListener("scroll", animateProducts);
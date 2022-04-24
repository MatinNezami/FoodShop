$.select("aside.menu", "menu");
$.select("#prevent", "prevent");
$.select("#message", "message");
$.select("#message p", "messageText");
$.select(".back-to-top", "back");

const renderMenu = ev => location.get("menu") && innerWidth <= 532? openMenu(ev): closeMenu();


function closeMenu () {
    $.menu.style.left = "-260px";
    $.body.style.overflow = "visible";
    $.prevent.style.zIndex = "-1";
}

function openMenu ({load}) {
    $.menu.style.left = 0;
    $.body.style.overflow = "hidden";
    $.prevent.style.zIndex = "2";

    if (load) {
        history.replaceState(null, "", location.remove("menu"));
        return history.pushState({open: true}, "", location.append({menu: "open"}));
    }

    if (history.state?.open) return;

    history.pushState({open: true}, "",
        location.get("menu")? location.search: location.append({menu: "open"})
    );
}

renderMenu({load: true});
self.addEventListener("popstate", renderMenu);

$.prevent.event("click", closeMenu, _ => history.back());
$.select("header nav .open").event("click", openMenu);


$.back.event("click", _ => scrollTo(0, 0));

window.addEventListener("scroll",
    _ => $.back.style.display = scrollY >= 130? "flex": "none"
);


function message (message) {
    if(!$.message)
        return null;

    if (!$.message.classList.contains("active")) {
        $.messageText.innerText = message;
        $.message.classList.add("active");
    }

    setTimeout (_ => {
        $.message.classList.remove("active");
    }, 3200);
}
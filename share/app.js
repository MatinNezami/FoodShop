$.select("aside.menu", "menu");
$.select("#prevent", "prevent");
$.select("#message", "message");
$.select("#message p", "messageText");
$.select(".back-to-top", "back");

const renderMenu = target => location.get("menu") && innerWidth <= 532? openMenu(target): closeMenu(target);

function closeMenu (target) {
    $.menu.style.left = "-260px";
    $.body.style.overflow = "visible";
    $.prevent.style.zIndex = "-1";

    history[target + "State"](null, "", location.remove("menu"));
}

function openMenu (target) {
    $.menu.style.left = 0;
    $.body.style.overflow = "hidden";
    $.prevent.style.zIndex = "2";

    history[target + "State"](null, "", location.append({page: "open"}));
}

renderMenu("replace");
window.addEventListener("popstate", _ => renderMenu("push"));

$.prevent.event("click", closeMenu);
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
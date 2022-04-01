$.select("aside.menu", "menu");
$.select("#prevent", "prevent");
$.select("#message", "message");
$.select("#message p", "messageText");
$.select(".back-to-top", "back");

function removeQuery (key) {
	const query = location.search.match(new RegExp(`${key}=[^&]*&?`))[0],
	    result = location.search.replaceAll(query, "");

	if (result < 2)
		return history.pushState(null, "", "/");

    if (result.endsWith("&"))
        return history.pushState(null, "", result.slice(0, -1));

	history.pushState(null, "", result);
}

function getRequest (key) {
    const regex = new RegExp(`${key}=.*`),
        match = location.search.match(regex);
      
    if (!match)
        return null;
      
    let end = match[0].search("&");
    if (end < 0) end = undefined;
      
    return match[0].slice(match[0].search("=") + 1, end);
}


function closeMenu () {
    $.menu.style.left = "-260px";
    $.body.style.overflow = "visible";
    $.prevent.style.zIndex = "-1";

    removeQuery("menu");
}

function openMenu (state) {
    $.menu.style.left = 0;
    $.body.style.overflow = "hidden";
    $.prevent.style.zIndex = "2";

    if (state)
        history.pushState(null, "",
            `${location.search? `${location.search}&`: '?'}menu=open`
        );
}

window.addEventListener("popstate", _ => getRequest("menu")? openMenu(null): closeMenu());

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
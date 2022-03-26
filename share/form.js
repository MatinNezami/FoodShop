$.inputs = $.querySelectorAll(".input input");

function findInput (current, next = 2) {
    if (!current || current.classList.contains("input"))
        return current;

    for (let i = 0; i < next; i++) {
        current = current?.nextElementSibling;

        if (current && current.classList.contains("input"))
            break;
    }

    return current?.classList?.contains("input")? current: null;
}

function next (event) {
    if (event.which != 13)
        return null;

    this.blur();
    const next = findInput(this.parentNode.nextElementSibling);

    if (next)
        return next.select("input").focus();

    this.offsetParent.offsetParent.select(".submit, .apply").click();
}

$.inputs.event("keydown", next);


function inputValue (input) {
    const placeholder = input.parentNode.select(".placeholder");

    if (!input.value)
        return null;

    placeholder.classList.add("active");

    if (input.required && placeholder.childElementCount < 1)
        placeholder.innerHTML = `<span>*</span> ${placeholder.innerText}`;
}

$.inputs.forEach(input => inputValue(input));


function focus () {
    const placeholder = this.parentNode.select(".placeholder");

    if (this.required && placeholder.innerHTML.search("span") < 0)
        setTimeout (_ => {
            placeholder.innerHTML = `<span>*</span> ${placeholder.innerText}`;
        }, 80);

    placeholder.classList.add("active");
}

function blur () {    
    if (this.value)
        return null;

    if (this.required)
        setTimeout (_ => {
            this.parentNode.select(".placeholder span")?.remove();
        }, 80);

    this.parentNode.select(".placeholder").classList.remove("active");
}

$.inputs.event("focus", focus, "blur", blur);

$.select(".placeholder").event("click", ev => ev.currentTarget.previousElementSibling.focus());


function password () {
    this.parentNode.parentNode.querySelectorAll("input[data-type=password]").forEach(
        input => input.type = this.checked? "text": "password"
    );
}

$.select(".show-password input").event("change", password);


function buttonDown () {
    this.classList.add("clicked");
}

function buttonUp () {
    this.classList.remove("clicked");
}

$.select("button, label")
    .event("pointerdown", buttonDown, "pointerup", buttonUp, "pointerleave", buttonUp);


async function ajax (url, data, method) {
    const request = data? await fetch(url, {
        method: method,
        body: data
    }): await fetch(url);

    if (!request.ok)
        return message("not found");

    const response = await request.json();

    if (response.message)
        message(response.message);

    return response;
}


function getRequest (key) {
    const regex = new RegExp(`${key + "="}.*`),
        match = location.search.match(regex);
      
    if (!match)
        return null;
      
    let end = match[0].search("&");
    if (end < 0) end = undefined;
      
    return match[0].slice(match[0].search("=") + 1, end);
}

function renderBox (targetBox, push = true) {
    const active = isExists("main > div.active");
    let box = targetBox instanceof Event? $[this.dataset.targetBox]: $[targetBox];

    if (box.dataset.logined && !client.login)
        box = $.login;

    if (box == active) return null;

    active?.classList?.remove("active")
    box.classList.add("active");

    if (!push) return box.id;
    
    history.pushState(null, "", `?page=${box.id}`);
}
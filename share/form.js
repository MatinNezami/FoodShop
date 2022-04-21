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
    if (event.which != 13) return;

    this.blur();
    const next = findInput(this.parentNode.nextElementSibling);

    if (next)
        return next.select("input").focus();

    this.offsetParent.offsetParent.select(".submit, .apply").click();
}

$.inputs.event("keydown", next);


function tinyNext (event) {
    const range = (event.which >= 48 && event.which <= 57) || event.which == 8;
    if (!this.nextElementSibling && !this.previousElementSibling || !range)
        return event.preventDefault();

    let input = this.nextElementSibling;

    if (event.which == 8)
        input = this.previousElementSibling;

    this.value = event.which == 8? "": String.fromCharCode(event.which);

    this.blur();
    event.preventDefault();
    input.focus();
}

$.querySelectorAll(".tiny-inputs input").event("keydown", tinyNext);


function inputValue (input) {
    const placeholder = input.parentNode.select(".placeholder");

    if (!input.value) return;

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
    if (this.value) return;

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


async function ajax ({url, data, cache = "no-cache", method}) {
    const request = data? await fetch(url, {
        method: method,
        body: data
    }): await fetch(url, {
        cache: cache
    });

    if (!request.ok) {
        message("not found");
        return {status: 500};
    }

    const response = await request.json();

    if (response.message)
        message(response.message);

    return response;
}

function renderBox (targetBox, push = true) {
    const active = isExists("main > div.active");
    let box = targetBox instanceof Event? $[this.dataset.targetBox]: $[targetBox];

    if (box.dataset.logined && !client.login)
        box = $.login;

    if (box == active) return;

    active?.classList?.remove("active")
    box.classList.add("active");

    if (!push) return box.id;
    
    history.pushState(null, "", `?page=${box.id}`);
}
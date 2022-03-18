$.inputs = $.querySelectorAll(".input input");

function inputValue (input) {
    const placeholder = input.parentNode.select(".placeholder");

    if (!input.value)
        return null;

    placeholder.classList.add("active");

    if (input.required)
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
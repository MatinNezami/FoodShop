"use strict";

function blobURL (base64) {
    let point = base64.search(";");
    const type = base64.slice(0, point);

    const bin = atob(base64.slice(++point));

    let byte = new Array(bin.length);

    for (let i = 0; i < byte.length; i++)
        byte[i] = bin.charCodeAt(i);

    return URL.createObjectURL(new Blob([new Uint8Array(byte)], {type: type}));
}

async function ajax (url, data, method) {
    const request = data? await fetch(url, {
        method: method,
        body: data
    }): await fetch(url);

    if (!request.ok)
        return message("not found");

    return JSON.parse(await request.text());
}


const profileImages = [];
window.src = {};

(async function profiles () {

    const response = await ajax("check.php?profiles");
    
    let parent = $.createElement("DIV");

    function set (data, i) {
        const box = i < 4? $.querySelector(".profile-images > div:first-of-type"): $.select(".profile-images > div:last-of-type"),
            img = new Image();

        img.draggable = false;
        img.alt = "profile";
        img.src = blobURL(data.img);
        img.dataset.name = data.key;
        img.onclick = selectProfile;

        window.src[data.key] = data.img;

        parent.appendChild(img);
        profileImages.push(img);

        if (i % 2 != 0) {
            parent.classList.add("center-item")
            box.appendChild(parent);
            parent = $.createElement("DIV");
        }
    }

    response.status == 200? response.data.forEach(set): message(response.message);

})();


$.select("header", "header");

$.select("#login-box", "login");
$.select("#signup-box", "signup");
$.select("#forgot-password-box", "forgot");
$.select("#informations-box", "information");

$.select("main > div", "mainBoxes");
$.select(".input input", "inputs");

const profilesBox = $.select(".profile-images"),
    reader = new FileReader();


showBox($[flag]);


function inputValue (input) {
    const placeholder = input.parentNode.select(".placeholder");

    if (!input.value)
        return null;

    placeholder.classList.add("active");

    if (input.required)
        placeholder.innerHTML = `<span>*</span> ${placeholder.innerText}`;
}

$.inputs.forEach(input => inputValue(input));


function headerImage () {
    if (window.innerWidth <= 500 || isExists("body > img"))
        return null;

    const img = new Image();

    img.src = "/images/account.webp";
    img.draggable = "false";
    img.alt = "background picture";

    $.body.insertBefore(img, $.header);
}

headerImage();

window.addEventListener("resize", headerImage);


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


function profile () {
    profilesBox.style.maxHeight = "500px";
    profilesBox.style.marginBottom = "25px";
}

function selectProfile () {
    if (isExists(".selected"))
        $.select(".selected").classList.remove("selected");

    this.classList.add("selected");
}

$.select(".profile").event("click", profile);


(function uploadImage (input, imageElm) {
    function insert () {
        window.uploadSrc = reader.result.slice(reader.result.search(":") + 1, reader.result.search(";")) + ";";
        window.uploadSrc += reader.result.slice(reader.result.search(",") + 1);

        imageElm.src = blobURL(window.uploadSrc);
        imageElm.style.display = "block";

        if (isExists(".selected"))
            $.select(".selected").classList.remove("selected");

        profileImages.forEach(img => img.onclick = null);
    }

    function remove () {
        this.style.display = "none";
        input.value = null;
        profileImages.forEach(img => img.onclick = selectProfile);
    }

    imageElm.event("click", remove);

    function upload () {
        reader.addEventListener("loadend", insert);
        reader.readAsDataURL(input.files[0]);
    }

    input.event("change", upload);
})($.select("#custom-profile", "profile"), $.select("#custom-profile-image"));


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

$.select("button").event("pointerdown", buttonDown, "pointerup", buttonUp, "pointerleave", buttonUp);
$.select("label").event("pointerdown", buttonDown, "pointerup", buttonUp, "pointerleave", buttonUp);


function showBox (targetBox) {
    function hide (box) {
        box.style.display = "none";
        box.style.opacity = "0";
    }

    function show (box) {
        box.style.display = "flex";

        setTimeout (_ => {
            box.style.opacity = "1";
        }, 10);
    }

    $.mainBoxes.forEach(box => hide(box));

    targetBox instanceof Event? show($[this.dataset.targetBox]): show(targetBox);
}

$.select("[data-target-box]").event("click", showBox);


function submit (element, data = false) {
    const validate = new Validate((element instanceof Event? this: element).parentNode.parentNode.select("form"))

    if (!validate.data)
        return null;

    if (data)
        return validate.data;

    validate.data.forEach(value => console.log(value));
}

$.select(".submit:not(#signup-box .submit)").event("click", submit);


function setInfo (data) {
    $.information.select("img").src = blobURL(data.profile);
    $.information.select("h2 span").innerText = data["first-name"]? data["first-name"]: "client";

    showBox($.information);
}

async function signup () {
    const data = submit(this, true),
        selected = isExists(".selected");

    if (!data)
        return null;

    if (!(selected || $.profile.files[0])) {
        Validate.error(profilesBox, "Select A Profile");
        return null;
    }

    data.append("profile", window.uploadSrc?? window.src[selected.dataset.name]);

    const response = await ajax("check.php", data, "POST");

    window.data = {};

    for (const item of data.entries())
        window.data[item[0]] = item[1];


    response.status == 200? setInfo(window.data): message(response.message);
}

$.signup.select(".submit").event("click", signup);
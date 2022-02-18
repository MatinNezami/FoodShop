$.select("header", "header");

$.select("#login-box", "login");
$.select("#signup-box", "signup");
$.select("#forgot-password-box", "forgot");
$.select("#informations-box", "information");

$.select("main > div", "mainBoxes");
$.select(".input input", "inputs");

const profilesBox = $.select(".profile-images"),
    profileImages = $.select(".profile-images img");


showBox($[flag]);


function inputValue (input) {
    if (input.value)
        input.parentNode.select(".placeholder").classList.add("active");
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
    this.parentNode.select(".placeholder").classList.add("active");
}

function blur () {    
    if (this.value)
        return null;

    this.parentNode.select(".placeholder").classList.remove("active");
}

$.inputs.event("focus", focus, "blur", blur);


function focusToInput () {
    this.previousElementSibling.focus();
}

$.select(".placeholder").event("click", focusToInput);


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
profileImages.event("click", selectProfile);


// work on this function
function uploadImage (input, imageElm) {
    const reader = new FileReader();

    function insert () {
        imageElm.src = reader.result;
        imageElm.style.display = "block";

        if (isExists(".selected"))
            $.select(".selected").classList.remove("selected");

        profileImages.forEach(img => img.removeEventListener("click", selectProfile));
    }

    function remove () {
        this.style.display = "none";
        profileImages.event("click", selectProfile);
    }

    imageElm.event("click", remove);

    function upload () {
        reader.addEventListener("loadend", insert);
        reader.readAsDataURL(input.files[0]);
    }

    input.event("change", upload)
}

uploadImage($.select("#custom-profile", "profile"), $.select("#custom-profile-image"));


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

        setTimeout(() => {
            box.style.opacity = "1";
        }, 10);
    }

    $.mainBoxes.forEach(box => hide(box));

    targetBox instanceof Event? show($[this.dataset.targetBox]): show(targetBox);
}

$.select("[data-target-box]").event("click", showBox);


function submit () {
    const validate = new Validate(this.parentNode.parentNode.select("form"));

    if (!validate.data)
        return null;

    validate.data.forEach(value => console.log(value));
}

$.select(".submit").event("click", submit);
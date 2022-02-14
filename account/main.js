$.select("header", "header");

function headerImage () {
    if (window.innerWidth <= 500 || isExists("body > img"))
        return null;

    const img = new Image();

    img.src = "/images/account.webp";
    img.draggable = "false";
    img.alt = "background picture";

    $.body.insertBefore(img, $.header);

    console.log("added");
}

headerImage();

window.addEventListener("resize", headerImage);


const profilesBox = $.select(".profile-images"),
    profileImages = $.select(".profile-images img");

$.select("#login-box", "login");
$.select("#signup-box", "signup");

switch (flag) {
    case "login":
        renderLoginBox();
    break;
    
    case "signup":
        renderSignupBox();
    break;
}

function focus () {
    this.parentNode.select(".placeholder").classList.add("active");
}

function blur () {    
    if (this.value)
        return null;

    this.parentNode.select(".placeholder").classList.remove("active");
}

$.select(".input input").event("focus", focus, "blur", blur);


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







// use function for prevent;
function renderLoginBox () {
    $.select("main > div").forEach(box => {
        box.style.display = "none";
        box.style.opacity = "0";
    });

    $.login.style.display = "flex";
    
    setTimeout(() => {
        
        
        $.login.style.opacity = "1";
    }, 10);
}

$.signup.select(".login").event("click", renderLoginBox);


function renderSignupBox () {
    $.select("main > div").forEach(box => {
        box.style.display = "none";
        box.style.opacity = "0";
    });

    $.signup.style.display = "flex";
    
    setTimeout(() => {
        $.signup.style.opacity = "1";
    }, 10);
}

$.login.select(".signup").event("click", renderSignupBox);

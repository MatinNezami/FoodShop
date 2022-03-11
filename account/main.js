const profileImages = [];
window.src = {};

let parent = $.createElement("DIV");
$.firstProfile = $.querySelector(".profile-images > div");
$.select(".profile-images > div:last-of-type", "lastProfile");

function insertProfile (data, i) {
    const img = new Image();

    img.draggable = false;
    img.alt = "profile";
    img.src = blobURL(data.img);
    img.dataset.name = data.key;
    img.onclick = selectProfile;

    window.src[data.key] = data.img;

    parent.appendChild(img);
    profileImages.push(img);

    if (i % 2 != 0) {
        parent.classList.add("center-item");
        (i < 4? $.firstProfile: $.lastProfile).appendChild(parent);
        parent = $.createElement("DIV");
    }
}

async function profiles () {
    const response = await ajax("check.php?type=profiles");

    response.status == 200? response.data.forEach(insertProfile): message(response.message);
}

$.select("header", "header");

$.select("#login-box", "login");
$.select("#signup-box", "signup");
$.select("#forgot-password-box", "forgot");
$.select("#informations-box", "information");

$.select("main > div", "mainBoxes");

const profilesBox = $.select(".profile-images"),
    reader = new FileReader();


showBox($[flag]);


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


function showProfiles () {
    profilesBox.style.maxHeight = "500px";
    profilesBox.style.marginBottom = "25px";
}

function selectProfile () {
    if (isExists(".selected"))
        $.select(".selected").classList.remove("selected");

    this.classList.add("selected");
}

$.select(".profile").event("click", profiles, showProfiles);


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


// function submit (element, data = false) {
//     const validate = new Validate((element instanceof Event? this: element).parentNode.parentNode.select("form"))

//     if (!validate.data)
//         return null;

//     if (data)
//         return validate.data;

//     // validate.data.forEach(value => console.log(value));
// }

// $.select(".submit:not(#signup-box .submit)").event("click", submit);


// function setInfo (data) {
//     $.information.select("img").src = blobURL(data.profile);
//     $.information.select("h2 span").innerText = data["firstName"]? data["firstName"]: "client";

//     showBox($.information);
// }

async function signup () {
    const validate = new Validate($.signup.select("form")),
        selected = isExists(".selected");

    if (!validate.data)
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

    message(response.message);
}

$.signup.select(".submit").event("click", signup);


async function logout () {
    const response = await ajax("check.php?type=logout");

    message(response.message);

    if (!response.status == 200)
        return null;
    
    $.userProfile.innerHTML = "";
    $.userProfile.appendChild($.userSVG.content.cloneNode(true));
    showBox($.login);
}

$.select(".logout").event("click", logout);


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
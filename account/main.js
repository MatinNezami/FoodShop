window.src = {};

let profileImages,
    profileParent = $.createElement("DIV");

$.firstProfile = $.querySelector(".profile-images > div");
$.select(".profile-images > div:last-of-type", "lastProfile");


async function createProfiles () {
    if (!profileImages && !(await profiles()))
        return null;

    return profileImages.map(profile => {
        const img = new Image();

        img.draggable = false;
        img.alt = "profile";
        img.src = blobURL(profile.img);
        img.dataset.name = profile.key;
        img.onclick = selectProfile;
    
        window.src[profile.key] = profile.img;
    
        return img;
    });
}

async function signupProfiles (img, i) {
    if ($.lastProfile.childElementCount == 2)
        return null;

    profileParent.appendChild(img);

    if (i % 2 != 0) {
        profileParent.classList.add("center-item");
        (i < 4? $.firstProfile: $.lastProfile).appendChild(profileParent);
        profileParent = $.createElement("DIV");
    }
}

async function profiles () {
    const response = await ajax("check.php?type=profiles");

    if (response.status == 500)
        return 0;

    profileImages = response.data;

    return 1;
}

$.select("header", "header");

$.select("#login-box", "login");
$.select("#signup-box", "signup");
$.select("#forgot-password-box", "forgot");
$.select("#informations-box", "information");
$.select("#change-informations-box", "change");

$.select("main > div", "mainBoxes");

$.information.select("h2 span", "clientName");

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

    $.select("#informations-box > img").src = $.change.select(".details-profile img").src = this.src;
}

$.select(".profile").event("click", async _ => (await createProfiles())?.forEach(signupProfiles), showProfiles);


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


function setInfo (data) {
    const profile = blobURL(data.profile),
        img = new Image(),
        link = document.createElement("A");

    link.href = "/account?inforamtion";
    link.appendChild(img);

    $.userProfile.innerHTML = "";
    $.userProfile.appendChild(link);

    img.src = $.change.select(".details-profile img").src = $.information.select("img").src = profile;
    $.clientName.innerText = data.firstName? data.firstName: "client";

    showBox($.information);
}

function checkChanged (inputs) {
    let changed = false;

    for (const input of inputs)
        if (input.defaultValue != input.value)
            changed = true;

    return changed;
}

async function signup () {
    const validate = new Validate($.signup.select("form")),
        selected = isExists(".selected");

    if (!validate.data)
        return null;

    if (!(selected || $.profile.files[0])) {
        Validate.error(profilesBox, "Select A Profile");
        return null;
    }

    validate.data.append("profile", window.uploadSrc?? window.src[selected.dataset.name]);

    const response = await ajax("check.php", validate.data, "POST");

    window.data = {};

    for (const item of validate.data.entries())
        window.data[item[0]] = item[1];
}

$.signup.select(".submit").event("click", signup);


async function logout () {
    const response = await ajax("check.php?type=logout");

    if (response.status == 500)
        return null;
    
    $.userProfile.innerHTML = "";
    $.userProfile.appendChild($.userSVG.content.cloneNode(true));
    showBox($.login);
}

$.select(".logout").event("click", logout);


function resetForm (selected, inputs) {
    inputs.forEach(input => input.defaultValue = input.value);

    window.uploadSrc = undefined;
    selected?.classList?.remove("selected");
}

async function login () {
    const validate = new Validate($.login.select("form"));

    if (!validate.data)
        return null;

    const response = await ajax("check.php", validate.data, "POST");

    if (response.status == 500)
        return null;
    
    $.login.select("input").forEach(input => input.value = "");
    setInfo(response.info);
}

$.login.select(".submit").event("click", login);


// IF USE MODAL BOX IN OTHER PAGE MOVE THIS CODE TO SHARE DIRECTORY

function openModal (event) {
    event.stopPropagation();

    ($[this.dataset.targetModal]?? $.select(`#${this.dataset.targetModal}`, this.dataset.targetModal))
        .classList.add("active");

    $[this.dataset.targetModal].select("*").event("click", ev => ev.stopPropagation());

    $[this.dataset.targetModal].querySelectorAll("label").forEach(
        label => $.select(`#${label.getAttribute("for")}`).event("click", ev => ev.stopPropagation())
    )

    $[this.dataset.targetModal].onclick = ev => ev.stopPropagation();
    $.body.onclick = closeModal;
}

function closeModal () {
    $.querySelectorAll(".modal.active").forEach(
        modal => modal.classList.remove("active")
    );

    $.body.onclick = undefined;
}

// IF USE MODAL BOX IN OTHER PAGE MOVE THIS CODE TO SHARE DIRECTORY

function changeProfiles (img, event) {
    if ($[event.srcElement.dataset.targetModal].childElementCount == 9)
        return null;

    const reference = $[event.srcElement.dataset.targetModal].querySelector("label");

    $[event.srcElement.dataset.targetModal].insertBefore(img, reference);
}

const changeProfilesHandler = async ev => (await createProfiles())?.forEach(img => changeProfiles(img, ev));

$.select("#change-profile-btn").event("click", openModal, changeProfilesHandler);


function insertChange (selected, inputs) {
    if (selected || window.uploadSrc)
        $.userProfile.select("img").src = $.change.select(".details-profile img").src;


    $.clientName.innerText = $.change.select("input[name=firstName]").value;    
    showBox($.information);

    resetForm(selected, inputs);
}

function changeInfoForm (selected, inputs) {
    const data = new FormData();

    inputs.forEach(input => {
        if (input.value != input.defaultValue)
            data.append(input.name, input.value);
    });

    if (selected || window.uploadSrc)
        data.append("profile", window.uploadSrc?? window.src[selected.dataset.name]);

    data.append("type", "change");

    return data;
}

async function changeInfo () {
    const selected = isExists(".selected"),
        inputs = $.change.select(".input input");

    if (!(selected || window.uploadSrc || checkChanged(inputs)))
        return null;
    
    const validate = new Validate($.change.select("form"));

    if (!validate.data)
        return null;
    
    const data = changeInfoForm(selected, inputs),
        response = await ajax("check.php", data, "POST");

    if (response.status == 200)
        insertChange(selected, inputs);
}

$.change.select(".apply").event("click", changeInfo);


(function uploadImage (input, imageElm) {
    function insert () {
        window.uploadSrc = reader.result.slice(reader.result.search(":") + 1, reader.result.search(";")) + ";";
        window.uploadSrc += reader.result.slice(reader.result.search(",") + 1);

        imageElm.src = blobURL(window.uploadSrc);
        imageElm.style.display = "block";

        $.select("#informations-box > img").src = $.change.select(".details-profile img").src = imageElm.src;
        
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
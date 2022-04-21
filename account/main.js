"use strict";
window.src = {};

let profileImages,
    profileParent = $.createElement("DIV");

$.firstProfile = $.querySelector(".profile-images > div");
$.select(".profile-images > div:last-of-type", "lastProfile");

$.select("main > div").forEach(
    box => $[box.id] = box
);

$.informations.select("h2 span", "clientName");
$["change-info"].select(".details-profile img", "detailsProfile");

const profilesBox = $.select(".profile-images"),
    reader = new FileReader(),
    page = getRequest("page");

history.replaceState(null, "", `${locationWithout("page")}page=${
    renderBox($[page]? page: "informations", false)
}`);


function image (src, alt) {
    const img = new Image();

    img.src = src;
    img.alt = alt;
    img.draggable = false;
    return img;
}


async function createProfiles () {
    const response = await ajax({url: "check.php?type=profiles", cache: "force-cache"});
    
    if (response.status == 500) return;
    
    return response.data.map(profile => {
            const img = image(blobURL(profile.img), "profile");

            img.dataset.name = profile.key;
            img.onclick = selectProfile;
        
            window.src[profile.key] = profile.img;
            return img;
        });
}

async function signupProfiles (img, i) {
    if ($.lastProfile.childElementCount == 2) return;

    profileParent.appendChild(img);

    if (i % 2 != 0) {
        profileParent.classList.add("center-item");
        (i < 4? $.firstProfile: $.lastProfile).appendChild(profileParent);
        profileParent = $.createElement("DIV");
    }
}


function headerImage () {
    if (innerWidth <= 500 || isExists("body > img")) return;

    const img = image("/images/account.webp", "background picture");
    $.body.insertBefore(img, $.header?? $.select("header", "header"));
}

headerImage();
addEventListener("resize", headerImage);


function selectProfile () {
    if (isExists(".selected"))
        $.select(".selected").classList.remove("selected");

    this.classList.add("selected");

    $.informations.select("img").src = $.detailsProfile.src = this.src;
}

$.select(".profile").event("click",
    async _ => (await createProfiles())?.forEach(signupProfiles),
    _ => profilesBox.classList.add("active")
);


addEventListener("popstate", _ => renderBox(getRequest("page"), false));

$.select("[data-target-box]").event("click", renderBox);


function checkChanged (inputs) {
    for (const input of inputs)
        if (input.defaultValue != input.value)
            var changed = true;

    return changed;
}

function insertInfo (data) {
    const img = image(blobURL(data.profile), "user profile"),
        link = $.createElement("A"),
        changeInputs = $["change-info"].select(".input input:not([name=password])"),
        email = $["change-email"].select(".input input[name=email]"),
        name = (data.firstName?? data["first-name"]).trim();

    $.informations.select("img").src = $.detailsProfile.src = img.src;

    link.href = "/account?page=informations";
    link.appendChild(img);

    $.userProfile.innerHTML = "";
    $.userProfile.appendChild(link);

    $.clientName.innerText = changeInputs[0].value = name? name: "client";
    changeInputs[1].value = data.username.trim();
    changeInputs.forEach(input => inputValue(input));

    email.defaultValue = email.value = data.email.trim();
    inputValue(email);

    resetForm(isExists(".selected"), changeInputs);
    renderBox("informations");
}

async function signup () {
    const validate = new Validate($.signup.select("form")),
        selected = isExists(".selected");

    if (!validate.data) return;

    if (!(selected || $.profile.files[0]))
        return Validate.error(profilesBox, "Select A Profile");

    validate.data.append("profile", window.uploadSrc?? window.src[selected.dataset.name]);

    if ((await ajax({url: "check.php", data: validate.data, method: "POST"})).status == 500) return;

    const data = {};
    validate.data.forEach((val, key) => data[key] = val);

    insertInfo(data);
    cleanInputs($.signup.select(".input input"));
}

$.signup.select(".submit").event("click", signup);


async function logout () {
    if ((await ajax({url: "check.php?type=logout"})).status == 500) return;
    
    client.login = false;

    $.userProfile.innerHTML = "";
    $.userProfile.appendChild($.user);
    renderBox("login");
}

$.select(".logout").event("click", logout);


function resetForm (selected, inputs) {
    inputs.forEach(input => input.defaultValue = input.value = input.value.trim());

    window.uploadSrc = undefined;
    selected?.classList?.remove("selected");
}


async function login () {
    const validate = new Validate($.login.select("form"));

    if (!validate.data) return;

    const response = await ajax({url: "check.php", data: validate.data, method: "POST"});

    if (response.status == 500) return;

    client.login = true;
    
    cleanInputs($.login.select(".input input"));
    insertInfo(response.info);
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
    );

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
    if ($[event.srcElement.dataset.targetModal].childElementCount == 9) return;

    const reference = $[event.srcElement.dataset.targetModal].querySelector("label");

    $[event.srcElement.dataset.targetModal].insertBefore(img, reference);
}

const changeProfilesHandler = async ev => (await createProfiles())?.forEach(img => changeProfiles(img, ev));

$.select("#change-profile-btn").event("click", openModal, changeProfilesHandler);


function insertChange (selected, inputs) {
    if (selected || window.uploadSrc)
        $.userProfile.select("img").src = $.detailsProfile.src;

    cleanInputs($["change-info"].select("input[name=password]"));

    $.clientName.innerText = $["change-info"].select("input[name=first-name]").value.trim();    
    renderBox("informations");

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
        password = $["change-info"].select("input[name=password]"),
        inputs = [...$["change-info"].select(".input input:not([name=password])")];

    if (!(selected || window.uploadSrc || checkChanged(inputs)))
        return Validate.error(inputs[0], "information hasn't changed");

    const validate = new Validate($["change-info"].select("form"));

    if (!validate.data) return;

    inputs.push(password);
    const data = {url: "check.php", data: changeInfoForm(selected, inputs), method: "POST"};

    if ((await ajax(data)).status == 500) return;

    insertChange(selected, inputs);
    cleanInputs(password);
}

$["change-info"].select(".apply").event("click", changeInfo);


function cleanInputs (inputs) {
    if (inputs instanceof Element)
        inputs = [inputs];

    inputs.forEach(input => {
        const placeholder = input.parentNode.select(".placeholder");
        
        input.value = "";
        placeholder.classList.remove("active");
        placeholder.select("span")?.remove();
    });
}

async function changePasswd () {
    const validate = new Validate($["change-password"].select("form")),
        inputs = [...$["change-password"].select(".input input:not([name=password])")];

    if (inputs[1].value && inputs[0].value == inputs[1].value)
        return Validate.error(inputs[1], "new password match with old password");

    if (!validate.data || (await ajax({url: "check.php", data: validate.data, method: "POST"})).status == 500) return;

    inputs.push($["change-password"].select("input[name=password]"));

    cleanInputs(inputs);
    renderBox("informations");
}

$["change-password"].select(".submit").event("click", changePasswd);


async function changeEmail () {
    const inputs = [$["change-email"].select(".input input:not([name=password])")];

    if (!checkChanged(inputs))
        return Validate.error(inputs[0], "email hasn't changed");

    const validate = new Validate($["change-email"].select("form"), false);

    if (!validate.data || (await ajax({url: "check.php", data: validate.data, method: "POST"})).status == 500) return;

    cleanInputs($["change-email"].select("input[name=password]"));
    renderBox("informations");
    resetForm(null, inputs)
}

$["change-email"].select(".submit").event("click", changeEmail);


async function forgotPasswd () {
    const validate = new Validate($["forgot-password"].select("form"));

    if (!validate.data || (await ajax({url: "check.php", data: validate.data, method: "POST"})).status == 500) return;

    renderBox("login");
}

$["forgot-password"].select(".submit").event("click", forgotPasswd);


(function uploadImage (input, imageElm) {
    function insert () {
        window.uploadSrc = reader.result.slice(reader.result.search(":") + 1, reader.result.search(";")) + ";";
        window.uploadSrc += reader.result.slice(reader.result.search(",") + 1);

        imageElm.style.display = "block";
        $.informations.select("img").src = $.detailsProfile.src = imageElm.src = blobURL(window.uploadSrc);
    }

    function remove () {
        this.style.display = "none";
        input.value = null;
    }

    imageElm.event("click", remove);

    function upload () {
        reader.addEventListener("loadend", insert);
        reader.readAsDataURL(input.files[0]);
    }

    input.event("change", upload);
})($.select("#custom-profile", "profile"), $.select("#custom-profile-image"));
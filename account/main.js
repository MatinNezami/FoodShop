window.src = {};

let profileImages,
    profileParent = $.createElement("DIV");

$.firstProfile = $.querySelector(".profile-images > div");
$.select(".profile-images > div:last-of-type", "lastProfile");

$.select("header", "header");

$.select("#login", "login");
$.select("#signup", "signup");
$.select("#forgot-password", "forgot-password");
$.select("#informations", "informations");
$.select("#change-info", "change-info");
$.select("#change-password", "change-password");
$.select("#change-email", "change-email");

$.informations.select("h2 span", "clientName");
$["change-info"].select(".details-profile img", "detailsProfile");

const profilesBox = $.select(".profile-images"),
    reader = new FileReader(),
    page = getRequest("page");


history.replaceState(null, "", `?page=${
    renderBox(!$[page]? "informations": page, false)
}`);


function image (src, alt) {
    const img = new Image();

    img.src = src;
    img.alt = alt;
    img.draggable = false;
    return img;
}


async function createProfiles () {
    return !profileImages && !(await profiles())? null:
        profileImages.map(profile => {
            const img = image(blobURL(profile.img), "profile");

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


function headerImage () {
    if (window.innerWidth <= 500 || isExists("body > img"))
        return null;

    const img = image("/images/account.webp", "background picture");
    $.body.insertBefore(img, $.header);
}

headerImage();

window.addEventListener("resize", headerImage);


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


window.addEventListener("popstate", _ => renderBox(getRequest("page"), false));

$.select("[data-target-box]").event("click", renderBox);


function checkChanged (inputs) {
    let changed;

    for (const input of inputs)
        if (input.defaultValue != input.value)
            changed = true;

    return changed;
}

function insertInfo (data) {
    const img = image(blobURL(data.profile), "user profile"),
        link = $.createElement("A"),
        changeInputs = $["change-info"].select(".input input:not([name=password])"),
        email = $["change-email"].select(".input input[name=email]");

    $.informations.select("img").src = $.detailsProfile.src = img.src;

    link.href = "/account?page=informations";
    link.appendChild(img);

    $.userProfile.innerHTML = "";
    $.userProfile.appendChild(link);

    $.clientName.innerText = changeInputs[0].value = data.firstName;
    changeInputs[1].value = data.username;
    changeInputs.forEach(input => inputValue(input));

    email.defaultValue = email.value = data.email;
    inputValue(email);

    resetForm(isExists(".selected"), changeInputs);
    renderBox("informations");
}

async function signup () {
    const validate = new Validate($.signup.select("form"), true, true),
        selected = isExists(".selected");

    if (!validate.data)
        return null;

    if (!(selected || $.profile.files[0]))
        return Validate.error(profilesBox, "Select A Profile");

    validate.data.append("profile", window.uploadSrc?? window.src[selected.dataset.name]);

    if ((await ajax("check.php", validate.data, "POST")).status == 500)
        return null;

    const data = {};
    validate.data.forEach((val, key) => data[key] = val);

    insertInfo(data);
    cleanInputs($.signup.select(".input input"));
}

$.signup.select(".submit").event("click", signup);


async function logout () {
    if ((await ajax("check.php?type=logout")).status == 500)
        return null;
    
    client.login = false;

    $.userProfile.innerHTML = "";
    $.userProfile.appendChild($.user);
    renderBox("login");
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
    if ($[event.srcElement.dataset.targetModal].childElementCount == 9)
        return null;

    const reference = $[event.srcElement.dataset.targetModal].querySelector("label");

    $[event.srcElement.dataset.targetModal].insertBefore(img, reference);
}

const changeProfilesHandler = async ev => (await createProfiles())?.forEach(img => changeProfiles(img, ev));

$.select("#change-profile-btn").event("click", openModal, changeProfilesHandler);


function insertChange (selected, inputs) {
    if (selected || window.uploadSrc)
        $.userProfile.select("img").src = $.detailsProfile.src;

        $["change-info"].select("input[name=password]").value = "";

    $.clientName.innerText = $["change-info"].select("input[name=firstName]").value;    
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

function sameUsername (username, password) {
    for (let item of username.toLowerCase().match(/.{1,3}/g)?? [])
        if (password.toLowerCase().includes(item)) return true;
}

async function changeInfo () {
    const selected = isExists(".selected"),
        password = $["change-info"].select("input[name=password]"),
        username = $["change-info"].select("input[name=username]");

    let inputs = [$["change-info"].select("[name=firstName]"), username];

    if (!(selected || window.uploadSrc || checkChanged(inputs)))
        return Validate.error(inputs[0], "information hasn't changed");

    if (sameUsername(username.value, password.value))
        return Validate.error(username, "username same with password");

    const validate = new Validate($["change-info"].select("form"), false, true);

    if (!validate.data)
        return null;

    inputs.push(password);

    if ((await ajax("check.php", changeInfoForm(selected, inputs), "POST")).status == 500)
        return null;

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
    const validate = new Validate($["change-password"].select("form"), false, true);
    let inputs = [...$["change-password"].select(".input input:not([name=password])")];

    if (inputs[1].value && inputs[0].value == inputs[1].value)
        return Validate.error(inputs[1], "new password match with old password");

    if (!validate.data || (await ajax("check.php", validate.data, "POST")).status == 500)
        return null;

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

    if (!validate.data || (await ajax("check.php", validate.data, "POST")).status == 500)
        return null;

    cleanInputs($["change-email"].select("input[name=password]"));
    renderBox("informations");
    resetForm(null, inputs)
}

$["change-email"].select(".submit").event("click", changeEmail);


async function forgotPasswd () {
    const validate = new Validate($["forgot-password"].select("form"));

    if (!validate.data || (await ajax("check.php", validate.data, "POST")).status == 500)
        return null;

    renderBox("login");
}

$["forgot-password"].select(".submit").event("click", forgotPasswd);


(function uploadImage (input, imageElm) {
    function insert () {
        if (!input.files[0].type.startsWith("image"))
            return message("your upload file isn't image");

        if (input.files[0].size > 10000000)
            return message("your upload file is long");

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
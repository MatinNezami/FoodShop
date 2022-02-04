const profilesBox = $.select(".profile-images"),
    profileImages = $.select(".profile-images img");

function focus () {
    const label = this.parentNode.select(".placeholder");
    
    label.style.top = "-13px";
    label.style.left = "5px";
    label.style.transform = "none";
    label.style.fontSize = "18px";
    label.style.transition = null;
    
    setTimeout(_ => {
        label.style.zIndex = "2";
        label.innerHTML = "<span>*</span> " + label.dataset.text;
    }, 170);
}

function blur () {
    const label = this.parentNode.select(".placeholder");

    setTimeout(_ => {
        if (!this.value)
            label.innerHTML = label.dataset.text;
    }, 170);
    
    if (this.value)
        return null;


    label.style.transition = "all 170ms ease-in 0s";
    label.style.top = null;
    label.style.left = null;
    label.style.transform = null;
    label.style.zIndex = null;
    label.style.fontSize = null;
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
    $.select("input[data-type=password]").forEach(input => input.type = (
        this.checked? "text": "password"
    ));
}

$.select(".show-password input").event("change", password);
$.select("#profile", "userProfile");
$.select("#mode", "mode");
$.user = $.select("#user").content.querySelector("svg");
$.moon = $.select("#moon").content.querySelector("svg");
$.sun = $.select("#sun").content.querySelector("svg");

function blobURL (base64) {
    let point = base64.search(";");

    const type = base64.slice(0, point),
        bin = atob(base64.slice(++point)),
        byte = new Array(bin.length);

    for (let i = 0; i < byte.length; i++)
        byte[i] = bin.charCodeAt(i);

    return URL.createObjectURL(new Blob([new Uint8Array(byte)], {type: type}));
}

(function profile () {

    if (!window.userProfile)
        return $.userProfile.appendChild($.user);

    const link = document.createElement("A"),
        img = new Image();

    link.href = "/account?page=informations";
    img.src = blobURL(userProfile);

    link.appendChild(img);
    $.userProfile.appendChild(link);

})();


(function mode () {

    if (!localStorage.getItem("dark"))
        return $.mode.appendChild($.moon);
    
    $.mode.appendChild($.sun);
    $.body.classList.add("dark");

})();


function changeMode () {
    $.mode.innerHTML = "";

    if (localStorage.getItem("dark")) {
        $.mode.appendChild($.moon);
        $.body.classList.remove("dark");
        return localStorage.setItem("dark", "");
    }

    $.mode.appendChild($.sun);
    $.body.classList.add("dark");
    localStorage.setItem("dark", true);
}

$.mode.event("click", changeMode);
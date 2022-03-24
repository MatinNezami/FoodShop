$.select("#profile", "userProfile");
$.svg = $.select("#svg").content;
$.select("#mode", "mode");
$.moon = $.svg.getElementById("moon");
$.sun = $.svg.getElementById("sun");

const dark = localStorage.getItem("dark");

function blobURL (base64) {
    let point = base64.search(";");
    const type = base64.slice(0, point);

    const bin = atob(base64.slice(++point));

    let byte = new Array(bin.length);

    for (let i = 0; i < byte.length; i++)
        byte[i] = bin.charCodeAt(i);

    return URL.createObjectURL(new Blob([new Uint8Array(byte)], {type: type}));
}

(function profile () {

    if (!window.userProfile)
        return $.userProfile.appendChild($.svg.getElementById("user"));

    const link = document.createElement("A"),
        img = new Image();

    link.href = "/account?page=informations";
    img.src = blobURL(userProfile);

    link.appendChild(img);
    $.userProfile.appendChild(link);

})();


(function mode () {

    if (!dark)
        return $.mode.appendChild($.moon);
    
    $.mode.appendChild($.sun);
    $.body.classList.add("dark");

})();


function changeMode () {
    $.mode.innerHTML = "";

    if (dark) {
        $.mode.appendChild($.moon);
        $.body.classList.remove("dark");
        return localStorage.setItem("dark", "");
    }

    $.mode.appendChild($.sun);
    $.body.classList.add("dark");
    localStorage.setItem("dark", true);
}

$.mode.event("click", changeMode);
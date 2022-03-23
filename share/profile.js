$.select("#profile", "userProfile");
$.select("#user", "userSVG");

function blobURL (base64) {
    let point = base64.search(";");
    const type = base64.slice(0, point);

    const bin = atob(base64.slice(++point));

    let byte = new Array(bin.length);

    for (let i = 0; i < byte.length; i++)
        byte[i] = bin.charCodeAt(i);

    return URL.createObjectURL(new Blob([new Uint8Array(byte)], {type: type}));
}

(_ => {

    if (window.userProfile) {
        const link = document.createElement("A"),
            img = new Image();

        link.href = "/account?page=informations";
        img.src = blobURL(userProfile);

        link.appendChild(img);
        $.userProfile.appendChild(link);
    }

    else
        $.userProfile.appendChild($.userSVG.content.cloneNode(true));

})();
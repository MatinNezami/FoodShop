$.select("#profile", "userProfile");

function blobURL (base64) {
    let point = base64.search(";");
    const type = base64.slice(0, point);

    const bin = atob(base64.slice(++point));

    let byte = new Array(bin.length);

    for (let i = 0; i < byte.length; i++)
        byte[i] = bin.charCodeAt(i);

    return URL.createObjectURL(new Blob([new Uint8Array(byte)], {type: type}));
}

(async _ => {

    const request = await fetch("/account/check.php?type=user-profile"),
        userSVG = _ => $.userProfile.appendChild($.select("#user").content.cloneNode(true));
    
    if (!request.ok)
        return userSVG();
    
    const response = JSON.parse(await request.text());

    if (response.status == 200) {
        const link = document.createElement("A"),
            profile = new Image();
        
        link.href = "/account?information";
        profile.src = blobURL(response.profile);

        link.appendChild(profile);
        $.userProfile.appendChild(link);
    }

    else
        userSVG();

})();
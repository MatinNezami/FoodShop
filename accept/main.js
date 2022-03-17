$.select("form", "form");

function getRequest (target) {
    target += "=";
    const regex = new RegExp(`${target}[^&]*`),
        result = location.search.match(regex)[0];

    return result.slice(result.search("=") + 1);
}

async function accept () {
    const validate = new Validate($.form, false);

    if (!validate.data)
        return null;

    validate.data.append("type", "accept");
    validate.data.append("token", getRequest("token"));

    const response = await ajax("/account/check.php", validate.data, "POST");

    message(response.message);

    if (response.status == 200)
        setTimeout(() => {
            location.replace("http://localhost/account?page=information");
        }, 3050);
}

$.select(".submit").event("click", accept);
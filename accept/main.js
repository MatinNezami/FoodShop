$.select("form", "form");

async function accept () {
    const validate = new Validate($.form);

    if (!validate.data)
        return null;

    validate.data.append("type", "accept");

    const response = await ajax("/account/check.php", validate.data, "POST");

    message(response.message);

    if (response.status == 200)
        setTimeout(() => {
            location.replace("localhost/account?information");
        }, 3050);
}

$.select(".submit").event("click", accept);
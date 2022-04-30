$.select("main > div").forEach(
    box => $[box.id] = box
);

(_ => {

    const page = client.box?? location.get("page");

    location.reference = location.remove("page");

    if ($[page])
        return history.replaceState(null, "",
            location.append({page: renderBox(page, false)})
        );


    history.replaceState(null, "", location.append({page: renderBox(page, false)}));

    location.reference = undefined;

})();

const redirect = _ => setTimeout(_ => location.replace("http://localhost/account"), 3000),
    token = location.get("token");

async function acceptAccount () {
    const validate = new Validate($["accept-account"].select("form"));

    if (!validate.ok) return;

    validate.data.append("type", "accept");
    validate.data.append("token", token);

    const data = {url: "/account/check.php", data: validate.data, method: "POST"};

    if ((await ajax(data)).status == 200) redirect();
}

$["accept-account"].select(".submit").event("click", acceptAccount);


async function resetPasswd () {
    const validate = new Validate($["reset-password"].select("form"));
    let acceptCode = "";

    if (!validate.ok) return;

    $["reset-password"].select(".tiny-inputs input").forEach(
        input => acceptCode += input.value
    );

    validate.data.append("accept-code", acceptCode);
    validate.data.append("token", token)

    const data = {url: "/account/check.php", data: validate.data, method: "POST"};

    if ((await ajax(data)).status == 200) redirect();
}

$["reset-password"].select(".submit").event("click", resetPasswd);
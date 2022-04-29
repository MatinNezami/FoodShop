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

async function acceptAccount () {
    const validate = new Validate($["accept-account"].select("form"));

    if (!validate.ok) return;

    validate.data.append("type", "accept");
    validate.data.append("token", location.get("token"));

    const data = {url: "/account/check.php", data: validate.data, method: "POST"};

    if ((await ajax(data)).status == 200)
        setTimeout(_ => location.replace("http://localhost/account"), 3000);
}

$["accept-account"].select(".submit").event("click", acceptAccount);
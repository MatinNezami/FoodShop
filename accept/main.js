$.select("main > div").forEach(
    box => $[box.id] = box
);

(_ => {

    const page = getRequest("page");
    
    if ($[page] && !isExists("main > div.active"))
        return renderBox(page, false);

    renderBox("error", false);
    history.replaceState(null, "", "?page=error");       

})();

async function acceptAccount () {
    const validate = new Validate($["accept-account"].select("form"));

    if (!validate.ok) return;

    validate.data.append("type", "accept");
    validate.data.append("token", getRequest("token"));

    const data = {url: "/account/check.php", data: validate.data, method: "POST"};

    if ((await ajax(data)).status == 200)
        setTimeout(_ => location.replace("http://localhost/account"), 3000);
}

$["accept-account"].select(".submit").event("click", acceptAccount);
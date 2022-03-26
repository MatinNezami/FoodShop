$.select("#accept-account", "accept-account");
$.select("#accept-code", "accept-code");
$.select("#error", "error");

(_ => {

    const page = getRequest("page");
    
    if ($[page] && !isExists("main > div.active"))
        return renderBox(page, false);

    renderBox("error", false);
    history.replaceState(null, "", "?page=error");       

})();

async function acceptAccount () {
    const validate = new Validate($["accept-account"].select("form"), false);

    if (!validate.data)
        return null;

    validate.data.append("type", "accept");
    validate.data.append("token", getRequest("token"));

    if ((await ajax("/account/check.php", validate.data, "POST")).status == 200)
        setTimeout(_ => location.replace("localhost/account"), 3000);
}

$["accept-account"].select(".submit").event("click", acceptAccount);
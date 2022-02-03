function focus () {
    const label = this.parentNode.querySelector("label");

    label.style.top = "-13px";
    label.style.left = "5px";
    label.style.transform = "none";
    label.style.fontSize = "18px";

    label.style.transition = null;
    
    setTimeout(() => {
        label.style.zIndex = "2";
    }, 170);
}

function blur () {
    if (this.value)
        return null;

    const label = this.parentNode.querySelector("label");

    label.style.transition = "all 170ms ease-in 0s";

    label.style.top = null;
    label.style.left = null;
    label.style.transform = null;
    label.style.zIndex = null;
    label.style.fontSize = null;
}


document.querySelectorAll("main .input input").forEach(input => {
    input.addEventListener("focus", focus);
    input.addEventListener("blur", blur);
});
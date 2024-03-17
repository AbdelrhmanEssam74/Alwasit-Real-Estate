

setTimeout(() => {
    if (menu.classList.contains("show_menu")) {
        menu.classList.remove("show_menu");
    }
}, 5000);


// animate navbar
window.addEventListener("scroll", function () {
    let header = document.querySelector("header")
    header.classList.toggle("sticky", window.scrollY);

});


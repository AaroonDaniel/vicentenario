document.addEventListener("DOMContentLoaded", function () {
    let menuButton = document.getElementById("menu_button");
    let closeButton = document.getElementById("close_nav");
    let navMenu = document.getElementById("nav_menu");

    if (menuButton && closeButton && navMenu) {
        // Abrir menú
        menuButton.addEventListener("click", function (event) {
            event.preventDefault();
            navMenu.classList.add("show");
        });

        // Cerrar menú
        closeButton.addEventListener("click", function (event) {
            event.preventDefault();
            navMenu.classList.remove("show");
        });
    } else {
        console.error("Error: No se encontraron los elementos del menú.");
    }
});

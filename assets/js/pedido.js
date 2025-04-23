var botones = document.querySelectorAll(".caja button"); // Seleccionar todos los botones dentro de los elementos con la clase "caja"
botones.forEach(function (boton) {
    boton.addEventListener("click", toggleDisplay); // Añadir un evento "click" a cada botón
});

function toggleDisplay(event) {
    var caja = event.target.closest(".caja"); // Encontrar el elemento padre más cercano con la clase "caja"
    var contenedor = caja.parentElement; // Subir al contenedor principal
    var desplegable = contenedor.querySelector(".desplegable"); // Buscar el elemento con la clase "desplegable" al nivel correcto

    if (desplegable.style.display === "block") {
        desplegable.style.display = "none"; // Si está visible, ocultarlo
    } else {
        desplegable.style.display = "block"; // Si está oculto, mostrarlo
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("product-modal");
    const closeModal = document.querySelector(".close-button");

    // Delegación de eventos para manejar los iconos de ojo dentro de la sección de productos
    document.body.addEventListener("click", function (e) {
        if (e.target.closest(".view-product")) {
            const icon = e.target.closest(".view-product");
            console.log("Abriendo modal");
            
            // Obtener los datos del producto desde el atributo data-product
            const product = JSON.parse(icon.getAttribute('data-product'));
            
            // Cargar los datos en el modal
            document.getElementById("modal-product-image").src = product.enlace;
            document.getElementById("modal-product-image").alt = product.nombreproducto;
            document.getElementById("modal-product-name").textContent = product.nombreproducto;

            let priceHtml = '';
            if (product.porcentajedescuento > 0) {
                priceHtml += `<span>Ahora: S/${product.preciodescuento}</span><span class="price-original">Antes: S/${product.preciooriginal}</span>`;
            } else {
                priceHtml += `<span>S/${product.preciooriginal}</span>`;
            }
            document.getElementById("modal-product-price").innerHTML = priceHtml;

            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += `<i class="${i <= product.calificacion ? 'fa-solid' : 'fa-regular'} fa-star"></i>`;
            }
            document.getElementById("modal-product-rating").innerHTML = starsHtml;

            modal.classList.remove("hidden"); // Mostrar el modal
        }
    });

    closeModal.addEventListener("click", () => {
        console.log("Cerrando Modal con la equis");
        modal.classList.add("hidden"); // Cerrar el modal
    });

    // Cerrar el modal al hacer clic fuera de él
    modal.addEventListener("click", (e) => {
        console.log("Cerrando Modal");
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });
});
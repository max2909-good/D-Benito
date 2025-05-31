
let cart = JSON.parse(localStorage.getItem("cart")) || [];


function updateCartCounter() {
    const cartCount = document.getElementById("cart-count");
    cartCount.textContent = cart.length;
}

function toggleCart() {
    const cartSidebar = document.getElementById("cartSidebar");
    cartSidebar.classList.toggle("open"); 

    
    if (cartSidebar.classList.contains("open")) {
        document.body.classList.add("cart-open");
    } else {
        document.body.classList.remove("cart-open");
    }
}


function renderCartItems() {
    const cartItemsContainer = document.getElementById("cartItems");
    cartItemsContainer.innerHTML = ""; 

    let total = 0;
    cart.forEach((item) => {
        const cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");

        
        cartItem.innerHTML = `
      <img src="${item.image}" alt="${item.name}">
      <div class="cart-item-details">
        <p class="cart-item-name">${item.name}</p>
        <p class="cart-item-price">S/${item.price}</p>
      </div>
      <!-- Icono de basura para eliminar el producto -->
      <span class="remove-item" onclick="removeFromCart('${item.name}')">
        <i class="fas fa-trash-alt"></i>
      </span>
    `;

        cartItemsContainer.appendChild(cartItem);
        total += item.price;
    });

    document.getElementById("cartTotal").textContent = total.toFixed(2);
}


document.querySelectorAll(".add-cart").forEach((btn) => {
    btn.addEventListener("click", function () {
        const product = {
            id: parseInt(this.getAttribute("data-id")),
            name: this.getAttribute("data-product"),
            price: parseFloat(this.getAttribute("data-price")),
            image: this.closest(".product-card").querySelector("img").src,
            quantity: 1
        };

        if (product.name && !isNaN(product.price)) {
           
            const productExists = cart.some((item) => item.name === product.name);
            if (productExists) {
                Swal.fire({
                    title: "Producto ya en el carrito",
                    html: `${product.name}<br><small>¡Ya está en tu carrito!</small>`, 
                    icon: "info",
                    confirmButtonText: "OK",
                });
            } else {
                cart.push(product);
                localStorage.setItem("cart", JSON.stringify(cart)); 
                Swal.fire({
                    title: "Producto añadido al carrito",
                    html: `${product.name}<br><small>¡ha sido añadido a tu carrito!</small>`, 
                    icon: "success",
                    confirmButtonText: "OK",
                });
                renderCartItems(); 
            }
        }
    });
});


function removeFromCart(productName) {
    cart = cart.filter((item) => item.name !== productName);
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCounter();
    renderCartItems();
}

document.getElementById("empty-cart").addEventListener("click", function () {
    cart = [];
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCounter();
    renderCartItems();
});


window.onload = function () {
    updateCartCounter();
    renderCartItems();
};

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("product-modal");
    const closeModal = document.querySelector(".close-button");

    
    document.body.addEventListener("click", function (e) {
        if (e.target.closest(".view-product")) {
            const icon = e.target.closest(".view-product");
            console.log("Abriendo modal");

            
            const product = {
                nombreproducto: icon.getAttribute('data-name'),
                enlace: icon.getAttribute('data-image'),
                preciooriginal: parseFloat(icon.getAttribute('data-price')).toFixed(2),
                calificacion: parseInt(icon.getAttribute('data-rating')),
                porcentajedescuento: icon.getAttribute('data-discount') || 0,
                preciodescuento: parseFloat((icon.getAttribute('data-price') * (1 - (icon.getAttribute('data-discount') / 100.0)))).toFixed(2)
            };

            
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

            modal.classList.remove("hidden"); 
        }
    });

    closeModal.addEventListener("click", () => {
        console.log("Cerrando Modal con la equis");
        modal.classList.add("hidden"); 
    });

    
    modal.addEventListener("click", (e) => {
        console.log("Cerrando Modal");
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });
});



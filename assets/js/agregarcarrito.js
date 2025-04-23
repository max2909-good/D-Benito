
function addToCart(idproducto) {
    console.log("ID del producto:", idproducto);  // Imprimir el idproducto en la consola
    var xhr = new XMLHttpRequest();  // Crear una nueva solicitud XMLHttpRequest
    xhr.open("POST", '../logic/agregarCarrito.php', true); // Configurar la solicitud POST
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Establecer el tipo de contenido para la solicitud
    xhr.withCredentials = true;
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) { 
            console.log(xhr.responseText);  // Verifica lo que llega del servidor
            if (xhr.responseText === "Debe iniciar sesión primero.") {
                showNotification("Debe iniciar sesión primero.");
            } else {
                showNotification("Producto añadido al carrito correctamente.");
                updateCarritoCount();
            }
        }
    };
    

    xhr.send("idproducto=" + idproducto);  // Enviar la solicitud con el ID del producto
}

function showNotification(message) {
    var notification = document.createElement('div');  // Crear un nuevo elemento div para la notificación
    notification.classList.add('notification');         // Añadir la clase 'notification' al div
    notification.textContent = message;                // Asignar el mensaje a mostrar

    console.log('Notificación creada:', notification);  // Verifica que la función se está ejecutando

    document.body.appendChild(notification);  // Añadir la notificación al cuerpo del documento

    // Desaparecer la notificación después de 2 segundos
    setTimeout(function() {
        document.body.removeChild(notification);
    }, 2000);  // La notificación desaparece después de 2 segundos
}

// Esta función realiza una nueva solicitud AJAX para obtener el número actualizado de productos en el carrito
function updateCarritoCount() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../logic/getCarritoCount.php", true); // Petición al archivo PHP que obtiene el número de productos
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var carritoCount = xhr.responseText;  // El número de productos en el carrito
            document.getElementById('carrito-count').textContent = `(${carritoCount})`;  // Actualiza el contador
        }
    };
    xhr.send();  // Enviar solicitud
} 
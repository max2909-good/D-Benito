document.addEventListener('DOMContentLoaded', function () {
    // Manejar el formulario de registro con AJAX
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío estándar del formulario
        var formData = new FormData(this);
        fetch('../login/login.php', {
            method: 'POST',
            body: formData // Enviar los datos del formulario
        })
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => {
                document.getElementById('loginMessage').innerHTML = data.message; // Mostrar el mensaje de respuesta
                if (data.success) {
                    // Redirigir a la página principal
                    window.location.href = data.redirect;
                }
            })
            .catch(error => {
                console.error('Error:', error); // Manejar cualquier error de la solicitud
            });
        
    });

    // Manejar el formulario de registro con AJAX
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar el envío estándar del formulario

        var formData = new FormData(this);

        fetch('../login/registro.php', {
            method: 'POST',
            body: formData // Enviar los datos del formulario
        })
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => {
                document.getElementById('registerMessage').innerHTML = data.message; // Mostrar el mensaje de respuesta
                if (data.success) {
                    // Redirigir o actualizar la página según necesites

                    this.reset(); // Limpiar el formulario después del registro exitoso
                }
            })
            .catch(error => {
                console.error('Error:', error); // Manejar cualquier error de la solicitud
            });
    });

document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPagina);

var contenedor_login_register = document.querySelector(".contenedor__login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

function anchoPagina() {
    if (window.innerWidth > 850) {
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";

    }
}
anchoPagina();
function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }

}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }

}
});
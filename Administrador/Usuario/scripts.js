
$(document).ready(function () {
    // Cargar todos los productos al iniciar
    loadUsuario();

    // Filtrar productos al seleccionar una categoría
    $('#rolFilter').change(function () {
        let rolId = $(this).val();
        loadUsuario(rolId);
    });
    // Función para cargar productos
    function loadUsuario(rolId = '') {
        $.ajax({
            url: 'loadUsuario.php',
            type: 'GET',
            data: { rol: rolId },
            success: function (response) {
                $('#UsuarioTable').html(response);
            }
        });
    }

    // Búsqueda en tiempo real
    $('#searchInput').on('keyup', function () {
        var query = $(this).val();
        $.ajax({
            url: "searchUsuario.php",
            type: "POST",
            data: { query: query },
            success: function (data) {
                $('#UsuarioTable').html(data);
            }
        });
    });

    $(document).on('click', '.empleado', function () {
        const usuarioId = $(this).data('id');
    
        // Enviar una solicitud AJAX para actualizar el producto
        $.ajax({
            url: 'updateEmpleado.php',  // Ruta para actualizar el descuento
            type: 'POST',
            data: { idusuario: usuarioId },
            success: function (response) {
                if (response === 'success') {
                    alert('Usuario cambiado a Empleado');
                    loadUsuario();
                } else {
                    alert('Error al cambiar a Empleado');
                }
            },
            error: function () {
                alert('Error al procesar la solicitud');
            }
        });
    });
    $(document).on('click', '.cliente', function () {
        const usuarioId = $(this).data('id');
    
        // Enviar una solicitud AJAX para actualizar el producto
        $.ajax({
            url: 'updateCliente.php',  // Ruta para actualizar el descuento
            type: 'POST',
            data: { idusuario: usuarioId },
            success: function (response) {
                if (response === 'success') {
                    alert('Usuario cambiado a Cliente');
                    loadUsuario();
                } else {
                    alert('Error al cambiar a Cliente');
                }
            },
            error: function () {
                alert('Error al procesar la solicitud');
            }
        });
    });
});
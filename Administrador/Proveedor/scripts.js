
$(document).ready(function () {
    // Cargar todos los productos al iniciar
    loadProveedor();

// Función para cargar productos
function loadProveedor() {
    $.ajax({
        url: 'loadProveedor.php', // Llama a loadProducts.php
        type: 'GET', // Tipo de solicitud
        success: function (response) {
            $('#proveedorTable').html(response); // Inserta la respuesta en la tabla
        }
    });
}

    // Búsqueda en tiempo real
    $('#searchInput').on('keyup', function () {
        var query = $(this).val();
        $.ajax({
            url: "searchProveedor.php",
            type: "POST",
            data: { query: query },
            success: function (data) {
                $('#proveedorTable').html(data);
            }
        });
    });

    // Agregar producto
    $('#addProveedorForm').submit(function (e) {
        e.preventDefault();
        
        $.post('addProveedor.php', $(this).serialize(), function (response) {
            alert(response);
            $('#addProveedorModal').modal('hide');
            loadProveedor();
            // Limpiar los campos del formulario
            $('#addProveedorForm')[0].reset();  // Limpiar todos los campos del formulario
        });
    });

    // Cargar productos para edición
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');  // Obtener el ID del producto desde el botón
        $.getJSON('getProveedor.php', { id }, function (data) {
            if (data.error) {
                alert(data.error);  // Si hay error, mostrar un mensaje
            } else {
                // Rellenar el modal con los datos del producto
                $('#edit_idproveedor').val(data.idproveedor);
                $('#editarnombreprov').val(data.nombreprov);
                $('#editardireccionprov').val(data.direccionprov);
                $('#editartelefonoprov').val(data.telefonoprov);
                $('#editaremailprov').val(data.emailprov);
                // Abrir el modal
                $('#editProveedorModal').modal('show');
            }
        });
    });



    // Editar producto
    $('#editProveedorForm').submit(function (e) {
        e.preventDefault();
        $.post('updateProveedor.php', $(this).serialize(), function (response) {
            alert(response);
            $('#editProveedorModal').modal('hide');
            loadProveedor();
        });
    });

    
});
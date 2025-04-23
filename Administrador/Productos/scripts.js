document.addEventListener('DOMContentLoaded', function () {
    // Elementos del modal agregar
    const tipoDescuento = document.getElementById('tipoDescuento');
    const descuentoPorcentajeDiv = document.getElementById('descuentoPorcentaje');
    const descuentoPrecioDiv = document.getElementById('descuentoPrecio');
    const porcentajedescuento = document.getElementById('porcentajedescuento');
    const preciodescuento = document.getElementById('preciodescuento');

      // Elementos del modal editar
      const editartipoDescuento = document.getElementById('editartipoDescuento');
      const editardescuentoPorcentajeDiv = document.getElementById('editardescuentoPorcentaje');
      const editardescuentoPrecioDiv = document.getElementById('editardescuentoPrecio');
      const editarporcentajedescuento = document.getElementById('editarporcentajedescuento');
      const editarpreciodescuento = document.getElementById('editarpreciodescuento');
      const editarpreciooriginal = document.getElementById('editarpreciooriginal');

    // Función para mostrar u ocultar los campos de descuento en el modal de agregar producto
    function toggleDescuentoFields() {
        if (tipoDescuento.value === 'porcentaje') {
            descuentoPorcentajeDiv.style.display = 'block';
            descuentoPrecioDiv.style.display = 'none';
          
        } else if (tipoDescuento.value === 'precio') {
            descuentoPorcentajeDiv.style.display = 'none';
            descuentoPrecioDiv.style.display = 'block';
           
        } else {
            descuentoPorcentajeDiv.style.display = 'none';
            descuentoPrecioDiv.style.display = 'none';
        }
    }

      // Función para mostrar u ocultar los campos de descuento en el modal de editar producto
      function toggleEditDescuentoFields() {
        if (editartipoDescuento.value === 'editarporcentaje') {
            editardescuentoPorcentajeDiv.style.display = 'block';
            editardescuentoPrecioDiv.style.display = 'none';
        } else if (editartipoDescuento.value === 'editarprecio') {
            editardescuentoPorcentajeDiv.style.display = 'none';
            editardescuentoPrecioDiv.style.display = 'block';
        } else {
            editardescuentoPorcentajeDiv.style.display = 'none';
            editardescuentoPrecioDiv.style.display = 'none';
        }
    }

    // Inicializar los campos de descuento en el modal de agregar producto
    tipoDescuento.addEventListener('change', toggleDescuentoFields);
    toggleDescuentoFields(); // Llamar para establecer el estado inicial del modal agregar

    // Inicializar los campos de descuento en el modal de editar producto
    editartipoDescuento.addEventListener('change', toggleEditDescuentoFields);
    toggleEditDescuentoFields(); // Llamar para establecer el estado inicial del modal editar

    // Función para calcular Precio con Descuento basado en Porcentaje
    porcentajedescuento.addEventListener('input', function () {
        const porcentaje = parseFloat(this.value);
        const precio = parseFloat(preciooriginal.value);
        if (!isNaN(porcentaje) && !isNaN(precio)) {
            const descuento = (porcentaje / 100) * precio;
            const precioFinal = precio - descuento;
            // Redondear a 2 decimales
            preciodescuento.value = precioFinal.toFixed(2);
        } else {
            preciodescuento.value = '';
        }
    });

    // Función para calcular Porcentaje de Descuento basado en Precio con Descuento
    preciodescuento.addEventListener('input', function () {
        const precioFinal = parseFloat(this.value);
        const precio = parseFloat(preciooriginal.value);
        if (!isNaN(precioFinal) && !isNaN(precio) && precio > 0) {
            const descuento = precio - precioFinal;
            let porcentaje = (descuento / precio) * 100;
            // Redondear a 2 decimales
            porcentaje = parseFloat(porcentaje.toFixed(2));
            if (!isNaN(porcentaje)) {
                porcentajedescuento.value = porcentaje;
            } else {
                porcentajedescuento.value = '';
            }
        } else {
            porcentajedescuento.value = '';
        }
    });
    // Opcional: Actualizar el precio con descuento si se cambia el precio original
    preciooriginal.addEventListener('input', function () {
        if (tipoDescuento.value === 'porcentaje' && porcentajedescuento.value) {
            const porcentaje = parseFloat(porcentajedescuento.value);
            const precio = parseFloat(this.value);
            if (!isNaN(porcentaje) && !isNaN(precio)) {
                const descuento = (porcentaje / 100) * precio;
                const precioFinal = precio - descuento;
                preciodescuento.value = precioFinal.toFixed(2);
            }
        } else if (tipoDescuento.value === 'precio' && preciodescuento.value) {
            const precioFinal = parseFloat(preciodescuento.value);
            const precio = parseFloat(this.value);
            if (!isNaN(precioFinal) && !isNaN(precio) && precio > 0) {
                const descuento = precio - precioFinal;
                const porcentaje = (descuento / precio) * 100;
                porcentajedescuento.value = porcentaje.toFixed(2);
            }
        }
    });
     // Función para calcular Precio con Descuento basado en Porcentaje
     editarporcentajedescuento.addEventListener('input', function () {
        const porcentaje = parseFloat(this.value);
        const precio = parseFloat(editarpreciooriginal.value);
        if (!isNaN(porcentaje) && !isNaN(precio)) {
            const descuento = (porcentaje / 100) * precio;
            const precioFinal = precio - descuento;
            // Redondear a 2 decimales
            editarpreciodescuento.value = precioFinal.toFixed(2);
        } else {
            editarpreciodescuento.value = '';
        }
    });

    // Función para calcular Porcentaje de Descuento basado en Precio con Descuento
    editarpreciodescuento.addEventListener('input', function () {
        const precioFinal = parseFloat(this.value);
        const precio = parseFloat(editarpreciooriginal.value);
        if (!isNaN(precioFinal) && !isNaN(precio) && precio > 0) {
            const descuento = precio - precioFinal;
            let porcentaje = (descuento / precio) * 100;
            // Redondear a 2 decimales
            porcentaje = parseFloat(porcentaje.toFixed(2));
            if (!isNaN(porcentaje)) {
                editarporcentajedescuento.value = porcentaje;
            } else {
                editarporcentajedescuento.value = '';
            }
        } else {
            editarporcentajedescuento.value = '';
        }
    });

    // Opcional: Actualizar el precio con descuento si se cambia el precio original
    editarpreciooriginal.addEventListener('input', function () {
        if (editartipoDescuento.value === 'editarporcentaje' && editarporcentajedescuento.value) {
            const porcentaje = parseFloat(editarporcentajedescuento.value);
            const precio = parseFloat(this.value);
            if (!isNaN(porcentaje) && !isNaN(precio)) {
                const descuento = (porcentaje / 100) * precio;
                const precioFinal = precio - descuento;
                editarpreciodescuento.value = precioFinal.toFixed(2);
            }
        } else if (editartipoDescuento.value === 'editarprecio' && editarpreciodescuento.value) {
            const precioFinal = parseFloat(editarpreciodescuento.value);
            const precio = parseFloat(this.value);
            if (!isNaN(precioFinal) && !isNaN(precio) && precio > 0) {
                const descuento = precio - precioFinal;
                const porcentaje = (descuento / precio) * 100;
                editarporcentajedescuento.value = porcentaje.toFixed(2);
            }
        }
    });

});

$(document).ready(function () {
    // Cargar todos los productos al iniciar
    loadProducts();

    // Filtrar productos al seleccionar una categoría
    $('#categoryFilter').change(function () {
        let categoryId = $(this).val();
        loadProducts(categoryId);
    });
    // Función para cargar productos
    function loadProducts(categoryId = '') {
        $.ajax({
            url: 'loadProducts.php',
            type: 'GET',
            data: { category: categoryId },
            success: function (response) {
                $('#productTable').html(response);
            }
        });
    }
    // Búsqueda en tiempo real
    $('#searchInput').on('keyup', function () {
        var query = $(this).val();
        $.ajax({
            url: "searchProducts.php",
            type: "POST",
            data: { query: query },
            success: function (data) {
                $('#productTable').html(data);
            }
        });
    });

    // Agregar producto
    $('#addProductForm').submit(function (e) {
        e.preventDefault();
        
        $.post('addProduct.php', $(this).serialize(), function (response) {
            alert(response);
            $('#addProductModal').modal('hide');
            loadProducts();
            // Limpiar los campos del formulario
            $('#addProductForm')[0].reset();  // Limpiar todos los campos del formulario
            toggleDescuentoFields();  // Restablecer la visibilidad de los campos de descuento
        });
    });

    // Cargar productos para edición
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');  // Obtener el ID del producto desde el botón
        $.getJSON('getProduct.php', { id }, function (data) {
            if (data.error) {
                alert(data.error);  // Si hay error, mostrar un mensaje
            } else {
                // Rellenar el modal con los datos del producto
                $('#edit_idproducto').val(data.idproducto);
                $('#editarnombreproducto').val(data.nombreproducto);
                $('#editarenlace').val(data.enlace);
                $('#editaridcategoria').val(data.idcategoria);
                $('#editaridproveedor').val(data.idproveedor);
                $('#editarpreciooriginal').val(data.preciooriginal);
                $('#editarporcentajedescuento').val(data.porcentajedescuento);
                $('#editarpreciodescuento').val(data.preciodescuento);
                $('#editarcalificacion').val(data.calificacion);
                $('#editarcantidad').val(data.cantidad);

                // Mostrar el tipo de descuento
                if (data.porcentajedescuento > 0) {
                    $('#editartipoDescuento').val('editarporcentaje');
                    $('#editardescuentoPorcentaje').show();
                    $('#editardescuentoPrecio').hide();
                } else {
                    $('#editartipoDescuento').val('editarprecio');
                    $('#editardescuentoPrecio').show();
                    $('#editardescuentoPorcentaje').hide();
                }

                // Abrir el modal
                $('#editProductModal').modal('show');
            }
        });
    });



    // Editar producto
    $('#editProductForm').submit(function (e) {
        e.preventDefault();
        $.post('updateProduct.php', $(this).serialize(), function (response) {
            alert(response);
            $('#editProductModal').modal('hide');
            loadProducts();
        });
    });

    // Eliminar producto
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            $.post('deleteProduct.php', { id }, function (response) {
                alert(response);
                loadProducts();
            });
        }
    });

    $(document).on('click', '.actualizarprecio', function () {
        const productId = $(this).data('id');
    
        // Enviar una solicitud AJAX para actualizar el producto
        $.ajax({
            url: 'updateDiscount.php',  // Ruta para actualizar el descuento
            type: 'POST',
            data: { idproducto: productId },
            success: function (response) {
                if (response === 'success') {
                    alert('Descuento quitado correctamente');
                    loadProducts();
                } else {
                    alert('Error al quitar descuento');
                }
            },
            error: function () {
                alert('Error al procesar la solicitud');
            }
        });
    });
    
});
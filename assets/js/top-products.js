$(document).ready(function () {
    // Detectar clic en las opciones
    $(".option").on("click", function () {
      // Remover la clase active de todas las opciones y agregarla a la opción seleccionada
      $(".option").removeClass("active");
      $(this).addClass("active");
  
      // Obtener el destino de la opción seleccionada
      var target = $(this).data("target");
  
      // Mostrar la sección correcta y ocultar las demás
      $(".product-section").hide();
      $("#" + target).show();
  
      // Llamar a la función para cargar los productos según el target
      cargarProductos(target);
    });
  
    // Cargar los productos destacados por defecto al cargar la página
    cargarProductos('destacados');
  
    function cargarProductos(categoria) {
      $.ajax({
        url: '/logic/top-products.php',
        type: 'POST',
        data: { categoria: categoria },
        success: function (response) {
          // Mostrar los productos en la sección correcta
          $("#" + categoria).html(response);
        },
        error: function () {
          console.log('Error al cargar los productos');
        }
      });
    }
  });
  
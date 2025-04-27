<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
  <?php include '../includes/header.php'; ?>
  <section>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/assets/img/banner1.jpg" class="d-block w-100" alt="Imagen 1">
          <div class="carousel-caption ">
            <p>Productos Selectos</p>
            <h5>100% Natural y Fresco<br> ¡Variedad para Todos los Gustos!</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="/assets/img/banner2.jpeg" class="d-block w-100" alt="Imagen 2">
          <div class="carousel-caption ">
            <p>Salud y Bienestar</p>
            <h5>Suministros Médicos de Calidad<br> ¡Cuida lo Que Más Amas!</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="/assets/img/banner3.jpeg" class="d-block w-100" alt="Imagen 3">
          <div class="carousel-caption ">
            <p>Delicias Lácteas</p>
            <h5>Yogur Cremoso y Saludable<br> ¡Sabor Natural en Cada Cucharada!</h5>
          </div>
        </div>
        <div class="carousel-item">
          <img src="/assets/img/banner4.jpeg" class="d-block w-100" alt="Imagen 3">
          <div class="carousel-caption ">
            <p>Hogar Brillante</p>
            <h5>Limpieza Eficiente y Ecológica<br> ¡Cuida Tu Espacio y el Planeta!</h5>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>
  </section>

  <main class="contenido">
    <!--BENEFICIOS-->
    <section class="container-fluid beneficios">
      <div class="row">
        <!--1 de 4-->
        <div class="col-6 col-md-3 tarjeta-beneficio">
          <div class="item-beneficio">
            <i class="fa-solid fa-truck-fast"></i>
            <div class="contenido-beneficio">
              <span>Envío gratuito</span>
              <p>En pedido superior a S/35</p>
            </div>
          </div>
        </div>
        <!--2 de 4-->
        <div class="col-6 col-md-3 tarjeta-beneficio">
          <div class="item-beneficio">
            <i class="fa-solid fa-wallet"></i>
            <div class="contenido-beneficio">
              <span>Reembolso</span>
              <p>100% garantía devolución de dinero</p>
            </div>
          </div>
        </div>
        <!--3 de 4-->
        <div class="col-6 col-md-3 tarjeta-beneficio">
          <div class="item-beneficio">
            <i class="fa-solid fa-percent"></i>
            <div class="contenido-beneficio">
              <span>Beneficio clientes Vip</span>
              <p>Beneficios especiales con descuento</p>
            </div>
          </div>
        </div>
        <!--4 de 4-->
        <div class="col-6 col-md-3 tarjeta-beneficio">
          <div class="item-beneficio">
            <i class="fa-solid fa-headset"></i>
            <div class="contenido-beneficio">
              <span>Servicio al cliente 24/7</span>
              <p>Llámenos 24/7 al 940-648-111</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--MEJORES CATEGORIAS-->
    <div class="container-fluid top-categorias">
      <div class="row titulo">
        <div class="col-md-12">
          <h1 class="heading-1">Mejores Categorías</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-6 col-md-4">
          <div class="categorias alimento">
            <p>Alimentos</p>
            <span><a href="">Ver más</a></span>
          </div>
        </div>
        <div class="col-6 col-md-4">
          <div class="categorias bebida">
            <p>Bebidas</p>
            <span><a href="">Ver Más</a></span>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="categorias lacteo">
            <p>Lácteos</p>
            <span><a href="">Ver Más</a></span>
          </div>
        </div>
      </div>
    </div>

    <!--MEJORES PRODUCTOS-->
    <div class="container-fluid Mejores Productos">
      <div class="row">
        <div class="col-md-12">
          <h1 class="heading-1"> Mejores Productos</h1>
        </div>
      </div>
      <!--Caja de opciones-->
      <div class="row caja-opciones">
        <!--solo el display es block cuando está en md-->
        <div class="col-4 col-md-3 d-none d-md-block"></div>
        <div class="col-md-6 container-options">
          <div class="row">
            <div class="col-4 col-md-4">
              <span class="option active" data-target="destacados">
                Destacados
              </span>
            </div>
            <div class="col-4 col-md-4">
              <span class="option" data-target="recientes">
                Últimos productos
              </span>
            </div>
            <div class="col-4 col-md-4">
              <span class="option" data-target="vendidos">
                Mayores Descuentos
              </span>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 d-none d-md-block"></div>
      </div>
    </div>
    <div class="container-fluid mt-4">
      <div class="product-grid product-section" id="destacados">

      </div>
      <div class="product-grid product-section" id="recientes" style="display: none;">

      </div>
      <div class="product-grid product-section" id="vendidos" style="display: none;">

      </div>
    </div>

    <div class="container-fluid container-galeria">
      <div class="row">
        <div class="col-3 col-md-3">
          <div class="row">
            <div class="col-md-12 galeria"><img src="/assets/img/frutas.jpeg" class="img-fluid" alt=""></div>
            <div class="col-md-12 galeria"><img src="/assets/img/verduras.jpeg" class="img-fluid" alt=""></div>
          </div>
        </div>
        <div class="col-6 col-md-6 galeria"><img src="/assets/img/tienda.jpeg" class="img-fluid" alt=""></div>
        <div class="col-3 col-md-3">
          <div class="row">
            <div class="col-md-12 galeria"><img src="/assets/img/yogurt.jpeg" class="img-fluid" alt=""></div>
            <div class="col-md-12 galeria"><img src="/assets/img/papeleria.jpeg" class="img-fluid" alt=""></div>
          </div>
        </div>
      </div>
    </div>
    <!--BLOGS-->
    <div class="container-fluid blogs">
      <h1 class="heading-1">Últimos Blogs</h1>
      <div class="row">
        <!-- Carta 1 -->
        <div class="col-md-4 d-flex align-items-stretch mb-4">
          <div class="card d-flex flex-column h-100">
            <img src="https://img-cdn.pixlr.com/image-generator/history/66ca3813b6854b7a730931ae/f272f29f-57f0-4cb5-bf30-43a6ccbf72f0/preview.webp" class="card-img-top" alt="Blog Image">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-start">Papa y Vino: Viaje Culinario</h5>
              <p class="card-date text-start">29 Noviembre 2022</p>
              <p class="card-text">Oda a la papa y el vino, explorando su historia, cultura y maridajes a través de seis secciones. Desde recetas familiares hasta eventos especiales y ciencia del maridaje, el blog invita a los lectores a un viaje culinario y enológico apasionante.</p>
              <div class="mt-auto">
                <a href="#">
                  <div class="btn-read-more">Leer más</div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Carta 2 -->
        <div class="col-md-4 d-flex align-items-stretch mb-4">
          <div class="card d-flex flex-column h-100">
            <img src="https://img-cdn.pixlr.com/image-generator/history/66ca38cb2540cbc85fdcb8f4/f9ffc4ce-f3fa-424a-bea4-a7ae0387d04e/preview.webp" class="card-img-top" alt="Blog Image">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-start">Explorando el Mundo Lácteo</h5>
              <p class="card-date text-start">09 Mayo 2024</p>
              <p class="card-text">D'Benito explora la leche: origen, maridajes, recetas, eventos y texturas innovadoras. Leche local, quesos, postres, recetas, eventos y sostenibilidad. Descubre la armonía entre la leche y productos frescos en D'Benito.</p>
              <div class="mt-auto">
                <a href="#">
                  <div class="btn-read-more">Leer más</div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Carta 3 -->
        <div class="col-md-4 d-flex align-items-stretch mb-4">
          <div class="card d-flex flex-column h-100">
            <img src="https://img-cdn.pixlr.com/image-generator/history/66ca390f0886b0d034f172fd/827b160d-bfbf-4b07-8a4c-3b863f71d2c2/preview.webp" class="card-img-top" alt="Blog Image">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-start">Descubriendo el Mundo de los Jugos</h5>
              <p class="card-date text-start">29 Noviembre 2022</p>
              <p class="card-text">El blog de la Bodega D'Benito explora el mundo de los jugos en botella, eventos, recetas y calidad, garantizando una experiencia excepcional para los amantes de la frescura y vitalidad de nuestros productos.</p>
              <div class="mt-auto">
                <a href="#">
                  <div class="btn-read-more">Leer más</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<!-- Contenedor del modal -->
<div id="product-modal" class="product-modal hidden">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <div class="modal-image">
            <img id="modal-product-image" src="" alt="" class="img-fluid">
        </div>
        <div class="modal-info">
            <h3 id="modal-product-name"></h3>
            <div class="modal-price" id="modal-product-price"></div>
            <div class="star-container" id="modal-product-rating"></div>
        </div>
    </div>
</div>
  <?php include '../includes/footer.html'; ?>
  <script src='../assets/js/top-products.js'></script>
</body>

</html>
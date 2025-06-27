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
       <!-- Modal para mostrar detalles del beneficio -->
<div id="benefit-modal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center">
          <i id="benefit-icon" class="fa-solid fa-truck-fast fa-3x mb-3"></i>
          <h4 id="benefit-title">Envío gratuito</h4>
          <p id="benefit-description">En pedido superior a S/35</p>
        </div>
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
    <!-- Modal para mostrar detalles del blog -->
<div id="blog-modal" class="modal fade" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center">
          <img id="blog-image" src="" alt="Imagen del Blog" class="img-fluid mb-3" style="border-radius: 15px;">
          <h4 id="blog-title" class="mb-3 text-primary">Título del Blog</h4>
          <p id="blog-date" class="text-muted mb-3">Fecha del Blog</p>
          <p id="blog-description" class="text-justify">Descripción del Blog</p>
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
<!-- Botón y ventana del Chatbot D'Benito -->
<style>
#chatbot-container {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 9999;
}
#openChatbot {
  background: #198754;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  font-size: 28px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s;
}
#openChatbot:hover {
  background: #145c32;
}
#chatbotWindow {
  display: none;
  width: 340px;
  height: 470px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.25);
  position: absolute;
  bottom: 70px;
  right: 0;
  flex-direction: column;
  overflow: hidden;
  border: 1px solid #e0e0e0;
}
#chatbotHeader {
  background: linear-gradient(90deg, #198754 80%, #145c32 100%);
  color: #fff;
  padding: 14px 18px;
  font-size: 18px;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
#closeChatbot {
  font-size: 22px;
  cursor: pointer;
  color: #fff;
  margin-left: 10px;
  transition: color 0.2s;
}
#closeChatbot:hover {
  color: #ffc107;
}
#chatbotMessages {
  flex: 1;
  padding: 16px;
  background: #f8f9fa;
  overflow-y: auto;
  font-size: 15px;
  max-height: 340px;
}
.chatbot-msg {
  margin-bottom: 12px;
  display: flex;
  align-items: flex-start;
}
.chatbot-msg.bot .bubble {
  background: #e9fbe5;
  color: #145c32;
  border-radius: 12px 12px 12px 4px;
  margin-right: auto;
}
.chatbot-msg.user .bubble {
  background: #198754;
  color: #fff;
  border-radius: 12px 12px 4px 12px;
  margin-left: auto;
}
.bubble {
  padding: 10px 14px;
  max-width: 80%;
  display: inline-block;
  word-break: break-word;
  box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
#chatbotForm {
  display: flex;
  border-top: 1px solid #e0e0e0;
  background: #fff;
}
#chatbotInput {
  flex: 1;
  border: none;
  padding: 12px;
  font-size: 15px;
  outline: none;
  background: #f8f9fa;
  border-radius: 0 0 0 16px;
}
#chatbotForm button {
  background: #198754;
  color: #fff;
  border: none;
  padding: 0 22px;
  font-size: 16px;
  border-radius: 0 0 16px 0;
  cursor: pointer;
  transition: background 0.2s;
}
#chatbotForm button:hover {
  background: #145c32;
}
.chatbot-options {
  margin: 10px 0 0 0;
  padding: 0;
  list-style: none;
}
.chatbot-options li {
  margin-bottom: 8px;
}
.chatbot-btn {
  background: #fff;
  color: #198754;
  border: 1px solid #198754;
  border-radius: 8px;
  padding: 6px 14px;
  font-size: 15px;
  cursor: pointer;
  margin-right: 8px;
  margin-bottom: 4px;
  transition: background 0.2s, color 0.2s;
}
.chatbot-btn:hover {
  background: #198754;
  color: #fff;
}
</style>

<div id="chatbot-container">
  <button id="openChatbot" title="¿Necesitas ayuda?">
    <i class="fa-solid fa-comments"></i>
  </button>
  <div id="chatbotWindow">
    <div id="chatbotHeader">
      <span><i class="fa-solid fa-robot"></i> D'Benito Bot</span>
      <span id="closeChatbot">&times;</span>
    </div>
    <div id="chatbotMessages"></div>
    <form id="chatbotForm" autocomplete="off">
      <input type="text" id="chatbotInput" placeholder="Escribe aquí..." autocomplete="off" />
      <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
    </form>
  </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script>
const openBtn = document.getElementById('openChatbot');
const chatWindow = document.getElementById('chatbotWindow');
const closeBtn = document.getElementById('closeChatbot');
const form = document.getElementById('chatbotForm');
const input = document.getElementById('chatbotInput');
const messages = document.getElementById('chatbotMessages');

let estado = 'inicio';

openBtn.onclick = () => {
  chatWindow.style.display = 'flex';
  if (messages.innerHTML.trim() === '') mostrarOpcionesIniciales();
};
closeBtn.onclick = () => chatWindow.style.display = 'none';

function agregarMensaje(texto, tipo = 'bot') {
  const div = document.createElement('div');
  div.className = 'chatbot-msg ' + tipo;
  div.innerHTML = `<div class="bubble">${texto}</div>`;
  messages.appendChild(div);
  messages.scrollTop = messages.scrollHeight;
}

function mostrarOpcionesIniciales() {
  messages.innerHTML = '';
  agregarMensaje(
    `¡Hola! Soy el asistente virtual de <b>D'Benito</b>.<br>¿En qué puedo ayudarte?`,
    'bot'
  );
  mostrarOpciones([
    { texto: '🛒 Información sobre productos', valor: 'productos' },
    { texto: '🕒 Horarios de atención', valor: 'horarios' },
    { texto: '📍 Ubicación de tiendas', valor: 'ubicacion' },
    { texto: '💬 Contactar a un asesor', valor: 'asesor' }
  ]);
  estado = 'inicio';
}

function mostrarOpciones(opciones) {
  
  const prev = messages.querySelector('.chatbot-options');
  if (prev) prev.remove();
  const ul = document.createElement('ul');
  ul.className = 'chatbot-options';
  opciones.forEach(op => {
    const li = document.createElement('li');
    const btn = document.createElement('button');
    btn.className = 'chatbot-btn';
    btn.textContent = op.texto;
    btn.onclick = () => {
      agregarMensaje(op.texto, 'user');
      procesarOpcion(op.valor);
    };
    li.appendChild(btn);
    ul.appendChild(li);
  });
  messages.appendChild(ul);
  messages.scrollTop = messages.scrollHeight;
}

form.onsubmit = function(e) {
  e.preventDefault();
  const userMsg = input.value.trim();
  if (!userMsg) return;
  agregarMensaje(userMsg, 'user');
  procesarMensajeLibre(userMsg);
  input.value = '';
};

function procesarOpcion(valor) {l
  if (valor === 'volver' || valor === 'volver_menu') {
    mostrarOpcionesIniciales();
    return;
  }
  
  if (valor === 'volver_productos') {
    mostrarProductos();
    return;
  }

  if (estado === 'inicio') {
    if (valor === 'productos') {
      mostrarProductos();
    } else if (valor === 'horarios') {
      agregarMensaje('Nuestro horario es de <b>Lunes a Sábado</b> de <b>8:00 a.m.</b> a <b>8:00 p.m.</b>');
      mostrarOpciones([
        { texto: '🔙 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
      estado = 'horarios';
    } else if (valor === 'ubicacion') {
      agregarMensaje('Nuestras tiendas están en:<br><b>Av. Principal 123</b> y <b>Calle Secundaria 456</b>.<br>¡Te esperamos!');
      mostrarOpciones([
        { texto: '🔙 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
      estado = 'ubicacion';
    } else if (valor === 'asesor') {
      mostrarContacto();
    }
  } else if (estado === 'productos') {
    if (valor === 'alimento') {
      agregarMensaje('Ofrecemos Arroz Pacasmayo, Arroz Caserita Extra, Arroz Paisana, Huevos. ¿Deseas saber precios o ver promociones?');
      mostrarOpciones([
        { texto: '💲 Ver precios', valor: 'precios_alimentos' },
        { texto: '🎁 Ver promociones', valor: 'promo_alimentos' },
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' }
      ]);
      estado = 'alimento';
    } else if (valor === 'lacteos') {
      agregarMensaje('Tenemos leche Gloria, Pura Vida, Bonle, Yogurt y más. ¿Qué te gustaría consultar?');
      mostrarOpciones([
        { texto: '💲 Ver precios', valor: 'precio_lacteos' },
        { texto: '🎁 Ver promociones', valor: 'promo_lacteos' },
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' }
      ]);
      estado = 'lacteos';
    } else if (valor === 'bebidas') {
      agregarMensaje('Contamos con jugos, gaseosas y más. ¿Qué deseas saber?');
      mostrarOpciones([
        { texto: '🥤 Ver lista de bebidas', valor: 'lista_bebidas' },
        { texto: '🎁 Ver promociones', valor: 'promo_bebidas' },
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' }
      ]);
      estado = 'bebidas';
    }
  } else if (estado === 'alimento') {
    if (valor === 'precios_alimentos') {
      agregarMensaje('Arroz Pacasmayo: <b>S/3.52</b><br>Arroz Caserita Extra: <b>S/3.80</b><br>Arroz Paisana: <b>S/5.61</b><br>Huevos: <b>S/8.46</b>');
      mostrarOpciones([
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
    } else if (valor === 'promo_alimentos') {
      agregarMensaje('¡Promoción! 5 kilos de arroz Paisana por <b>S/5.00</b> solo hoy.');
      mostrarOpciones([
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
    }
  } else if (estado === 'lacteos') {
    if (valor === 'precio_lacteos') {
      agregarMensaje('Gloria <b>S/4.00</b>, Pura Vida <b>S/3</b>, Bonle <b>S/2.60</b>, Yogurt <b>S/7</b>. ¡Pregunta por sabores disponibles!');
      mostrarOpciones([
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
    } else if (valor === 'promo_lacteos') {
      agregarMensaje('¡Promo! 6 Yogurt por <b>S/39</b>. Solo esta semana.');
      mostrarOpciones([
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
    }
  } else if (estado === 'bebidas') {
    if (valor === 'lista_bebidas') {
      agregarMensaje('Pepsi, Inka Kola, Sprite, Fanta y más. ¡Pregunta por tu bebida favorita!');
      mostrarOpciones([
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
    } else if (valor === 'promo_bebidas') {
      agregarMensaje('¡Promo! 2 Sprite 500ml por <b>S/4</b>. Solo hoy.');
      mostrarOpciones([
        { texto: '🔙 Volver a productos', valor: 'volver_productos' },
        { texto: '🏠 Volver al menú principal', valor: 'volver' },
        { texto: '💬 Contactar a un asesor', valor: 'asesor' }
      ]);
    }
  } else if (['horarios', 'ubicacion'].includes(estado)) {
    if (valor === 'asesor') {
      mostrarContacto();
    }
  } else if (estado === 'contacto') {
    if (valor === 'volver_menu') {
      mostrarOpcionesIniciales();
    }
  }
}

function mostrarProductos() {
  agregarMensaje('¿Sobre qué tipo de producto deseas información?');
  mostrarOpciones([
    { texto: 'Alimentos', valor: 'alimento' },
    { texto: 'Bebidas', valor: 'bebidas' },
    { texto: 'Lácteos', valor: 'lacteos' },
    { texto: '🔙 Volver al menú principal', valor: 'volver' }
  ]);
  estado = 'productos';
}


function mostrarContacto() {
  agregarMensaje(
    `Te estamos conectando con un asesor en línea...<br>
    Si no se abre el chat, haz clic en el botón de Chatra en la esquina.<br>
    ¿Deseas volver al menú principal?`,
    'bot'
  );
  mostrarOpciones([
    { texto: '🔙 Sí, volver al menú principal', valor: 'volver_menu' }
  ]);
  estado = 'contacto';

 
  if (window.Chatra) {
    window.Chatra('openChat', true);
  }
}

function procesarMensajeLibre(msg) {
  if (estado === 'contacto') {
    mostrarOpcionesIniciales();
  } else {
    agregarMensaje('Por favor, selecciona una opción del menú o haz clic en "Contactar a un asesor" si necesitas ayuda personalizada.');
  }
}
</script>

<script>
    (function(d, w, c) {
        w.ChatraID = 'dSePuJ9dithyd72SP';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = 'https://call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
</script>
</script>
  <script src="/assets/js/benefits-modal.js"></script>
  <script src="/assets/js/blog-modal.js"></script>
  <script src='../assets/js/top-products.js'></script>
  <?php include '../includes/footer.html'; ?>
</body>

</html>
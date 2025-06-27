<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/pedido.css">
    <title>Pedido</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>


    <main>
        <div class="container-fluid contenidoped">
<?php
        include('../logic/ListaPedido.php');
        ?>
</div>
    </main>

    <?php include '../includes/footer.html'; ?>
    <script src='../assets/js/pedido.js'></script>
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
<!-- Botón y ventana del Chatbot D'Benito -->


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

function procesarOpcion(valor) {
  // Volver al menú principal desde cualquier estado
  if (valor === 'volver' || valor === 'volver_menu') {
    mostrarOpcionesIniciales();
    return;
  }
  // Volver a productos desde cualquier estado
  if (valor === 'volver_productos') {
    mostrarProductos();
    return;
  }

  // Menú principal
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
  }
  // Submenú productos
  else if (estado === 'productos') {
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
  }
  // Submenú alimentos
  else if (estado === 'alimento') {
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
  }
  // Submenú lácteos
  else if (estado === 'lacteos') {
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
  }
  // Submenú bebidas
  else if (estado === 'bebidas') {
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
  }
  // Desde horarios o ubicación
  else if (['horarios', 'ubicacion'].includes(estado)) {
    if (valor === 'asesor') {
      mostrarContacto();
    }
  }
  // Desde contacto
  else if (estado === 'contacto') {
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
</body>

</html>
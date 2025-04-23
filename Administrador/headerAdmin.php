<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
 <!--ENCABEZADO-->
 <div class="container-fluid encabezado">
    <div class="row align-items-center">
      <!-- 4 -->
      <div class="col-4 col-md-4 izquierda">
        <i class="fa-solid fa-headset"></i>
        <div class="row">
          <div class="col-12 col-md-12">
            Servicio al cliente
          </div>
          <div class="col-12 col-md-12">
            943-072-035
          </div>
        </div>
      </div>
      <!-- 4 -->
      <div class="col-4 col-md-4 centro">
        <div class="centro-contenido">
          <i class="fa-solid fa-shop"></i>
          <h1><a href='../pages/Principal.php'>D'BENITO</a></h1>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-4 col-md-4 col-lg-4 derecha text-right">
        <?php
        if (isset($_SESSION['usuario'])) {
          // Si la sesión está iniciada, muestra el ícono del usuario con el tooltip
          echo '
            <div class="user-icon">
              <i class="fa-solid fa-user" id="userIcon"></i>
            </div>';
        } else {
          // Si no está iniciada, redirige al login
          echo '<a href="../pages/login.html"><i class="fa-solid fa-user"></i></a>';
        }
        ?>
      </div>
    </div>
  </div>
  <!-- Tooltip con datos del usuario -->
  <?php
  if (isset($_SESSION['usuario'])) {
    echo '
    <div class="tooltip-box" id="tooltipBox">
      <p><strong> Usuario: </strong> <br> ' . $_SESSION['usuario'] . '</p>
      <p><strong> Cliente: </strong> <br> ' . $_SESSION['nombreusuario'] . '</p>
      <form method="post" action="../../login/login.php">
          <input type="hidden" name="accion" value="logout">
          <button type="submit">Cerrar sesión</button>
      </form>
    </div>';
  }
  ?>
<!--NAVBAR-->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Menú</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href='../Inicio/indexAdmi.php'>Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href='../Productos/productos.php'>Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href='../Proveedor/proveedor.php'>Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href='../Pedidos/pedidos.php'>Pedidos</a>
                </li>
                
                <?php if (isset($_SESSION['idrol']) && $_SESSION['idrol'] == 1): ?>
                  <li class="nav-item">
                    <a class="nav-link" href='../Ventas/ventas.php'>Ventas</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href='../Usuario/usuario.php'>Usuario</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>
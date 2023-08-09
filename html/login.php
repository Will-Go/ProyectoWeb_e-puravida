<?php

try {
  include("db.php");
  session_start();
  if (isset($_SESSION['userLoggedin']) && $_SESSION['userLoggedin'] == true) {
    header("Location: index.php");
    exit();
  }
  if (isset($_POST['correo']) && isset($_POST['contra'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $email = $_POST['correo'];
      $password = $_POST['contra'];

      $query = "SELECT * FROM cliente WHERE correo = '$email' and contraseña = '$password'";
      $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);
      if ($count == 1) {
        session_start();
        $_SESSION['cliente'] = mysqli_fetch_assoc($result);
        $_SESSION['userLoggedin'] = true;
        $nombre = $_SESSION['cliente']['nombre'];
        echo "<script>alert('Bienvenido $nombre ')</script> <script>window.location.href = 'index.php';</script>";
        // header("Location: login.php");

      } else {
        header("Location: login.php?error=Credenciales incorrectos!");

      }
    }
  }
} catch (Exception $e) {
  header("Location: login.php?error=Credenciales incorrectos!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio de Sesion</title>
  <link rel="icon" href="../imagenes/LogoInvertido.ico" />

  <link rel="stylesheet" href="../css/bootstrap5.min.css" />

  <link rel="stylesheet" href="../css/login.css" />
  <!-- Buscar Iconos en la Pagina "https://remixicon.com/" -->
  <link rel="stylesheet" href="../css/remixicon.css" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-1 shadow mb-3 bg-body rounded" id="menu">
      <div class="container">
        <div>
          <a class="navbar-brand" href="#">
            <img id="E-PuraVidaLogo" src="../imagenes/E-PuraVidaLogo.png" alt="E-PuraVidaLogo" width="125" />
          </a>
        </div>
        <button class="navbar-toggler mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../html/index.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/mapa.php">Lugares</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/paquetes.php">Paquetes</a>
            </li>


            <li class="nav-item">
              <a class="btn btn-success p-1 me-1" href="../html/sigin.php">Crear Cuenta</a>
              <a class="btn btn-outline-secondary p-1" href="../html/login.php">
                Iniciar Sesion
              </a>



            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <section class="container">
    <div id="formulario" class="card p-5 my-5 form-signin bg-light text-center">
      <i class="ri-account-circle-fill" style="font-size: 100px"></i>

      <h1 class="h3 mb-3 fw-normal">Bienvenido!</h1>
      <?php if (isset($_GET['error'])) { ?>
        <div class='alert alert-danger' role='alert'>
          <i class='ri-error-warning-line fs-5'></i>
          <?php echo $_GET['error']; ?>
        </div>
      <?php } ?>
      <form action="login.php" method="POST">

        <div class="form-floating my-2">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo" />
          <label for="floatingInput">Correo Electronico</label>
        </div>
        <div id="password" class="form-floating my-2">
          <i id="ojo" class="ri-eye-off-fill"></i>
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contra" />
          <label for="floatingPassword">Contraseña </label>
        </div>

        <button class="w-100 btn btn-lg btn-success" type="submit">
          Iniciar
        </button>
        <a href="../html/sigin.php" class="link pt-5 mt-3">Crear cuenta</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2021–2023</p>
      </form>
    </div>
  </section>
  <script src="../js/login.js"></script>
  <script src="../js/bootstrap5.bundle.js"></script>

</body>

</html>
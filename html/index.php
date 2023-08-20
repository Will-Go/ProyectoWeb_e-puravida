<?php
include("db.php");
//$cliente es el objeto con los datos del usuario
include("userSession.php");

if (isset($con)) {
  $query = "SELECT COUNT(*) AS total_paquetes FROM paquete";
  $result = mysqli_fetch_assoc(mysqli_query($con, $query));
  $total_paquetes = $result['total_paquetes'];

  //GENERA 3 NUMEROS RANDOMS Y LOS GUARDA EN $numeros

  $numeros = array();
  for ($i = 1; $i <= 3; $i++) {
    do {
      $randomNumber = rand(1, $total_paquetes);
    } while (in_array($randomNumber, $numeros));

    $numeros[] = $randomNumber;
  }
  $a = $numeros[0];
  $b = $numeros[1];
  $c = $numeros[2];
  $query2 = "SELECT * FROM paquete WHERE id_paquete IN ('$a','$b','$c')";
  $result1 = mysqli_query($con, $query2);
  $result = mysqli_query($con, $query2);

  //DAR LAS TRES IMAGENES
  $Imagenes = array();
  while ($paquete1 = mysqli_fetch_assoc($result1)) {
    $id_lugar1 = $paquete1['id_lugar'];
    $query1 = "SELECT img, nombre FROM lugar WHERE id_lugar = '$id_lugar1'";
    $result3 = mysqli_fetch_assoc(mysqli_query($con, $query1));
    $Imagenes[] = $result3['img'];
  }


}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Excurciones Pura Vida!</title>
  <link rel="icon" href="../imagenes/LogoInvertido.ico" />

  <link rel="stylesheet" href="../css/bootstrap5.min.css" />

  <link rel="stylesheet" href="../css/index.css" />
  <!-- Buscar Iconos en la Pagina "https://remixicon.com/" -->
  <link rel="stylesheet" href="../css/remixicon.css" />
  <script src="../js/jquery.js"></script>
  <style>
    video {
      width: 100% !important;
      max-height: 36rem !important;
      object-fit: cover;
      position: relative;
    }
  </style>
</head>

<body>
  <!-- <header class="container-fluid d-flex justify-content-center">
      <p class="text-light mb-0 p-2 fs-6">
        <i class="ri-phone-fill m-2"></i><span>(506) 1010-0000</span>
      </p>
      <p class="text-light mb-0 p-2 fs-6">
        <i class="ri-mail-line m-2"></i><span>E@mail.com</span>
      </p>
    </header> -->

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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Nosotros
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#Nosotros">Nosotros</a></li>
              <li>
                <a class="dropdown-item" href="#Contactanos">Contactanos</a>
              </li>
            </ul>
          </li>
          <?php
          if (isset($cliente)) { ?>
            <li class="nav-item dropdown">
              <a class="ri-account-circle-fill fs-1 me-4 btn dropdown-toggle" role="button" id="dropdownMenuLink"
                data-bs-toggle="dropdown" aria-expanded="false"></a>
              <ul class="dropdown-menu w-75" aria-labelledby="dropdownMenuLink" style="position: absolute">
                <li>
                  <div class="p-2">
                    <p class="text-wrap text-break">
                      <?= $cliente['nombre'] ?>
                    </p>

                    <hr>
                    <a class="btn btn-outline-danger fs-6" href="../html/destroySession.php"> Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
              <?php
          } else {
            ?>
            <li class="nav-item">
              <a class="btn btn-success p-1 me-1" href="../html/sigin.php">Crear Cuenta</a>
              <a class="btn btn-outline-secondary p-1" href="../html/login.php">
                Iniciar Sesion
              </a>
              <?php
          }
          ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
        aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <!-- PONER LAS imagenes -->

      <div class="carousel-item active">
        <img src="../imagenes/<?= $Imagenes[0] ?>" class="w-100" />
      </div>
      <div class="carousel-item">
        <img src="../imagenes/<?= $Imagenes[1] ?>" class="w-100" />
      </div>
      <div class="carousel-item">
        <img src="../imagenes/<?= $Imagenes[2] ?>" class="w-100" />
      </div>
      <div class="carousel-item position-relative" data-bs-interval="60000">
        <a target="_blank" href="https://www.youtube.com/watch?v=QXt21aGi_nQ&t=6s">
          <video autoplay loop muted="true">
            <source src="../imagenes/video.mp4" type="video/mp4">
          </video>
          <p
            class="position-absolute bottom-0 start-0 badge fw-bold fst-italic ms-2 text-light fs-6 bg-secondary text-wrap">
            Creditos a:
            "TUCAYA
            TRAVEL"</p>
        </a>
      </div>
      <!-- PONER LAS imagenes -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <section class="d-flex flex-column pt-5 text-center w-75 m-auto my-3" id="intro">
    <h1 class="p-3 fs-2 border-top">
      Descubre la magia de <span>Costa Rica</span>: ¡Tu aventura inolvidable
      comienza aquí!
    </h1>
    <p class="p-3 fs-4">
      <span>Excurciones Pura Vida.</span> es la agencia donde te ayudamos
      encontrar los mejores paquetes para turistear!
    </p>
    <div class="bg-light">
      <h1 id="Nosotros">Nosotros</h1>
      <p class="p-3 fs-6 fw-light">
        <span>E-Pura Vida</span> es una empresa especializada en ofrecer
        experiencias de turismo rural, y comenzó a funcionar el 1 de octubre
        de 2021.
      </p>

      <p class="p-3 fs-6 fw-light">
        Nuestro principal objetivo es organizar excursiones tanto dentro como
        fuera del país, con el propósito de fomentar la actividad física y el
        bienestar mental de las personas. A través de nuestros tours y
        caminatas a parques nacionales, cascadas, montañas y zonas rurales,
        buscamos mejorar la salud integral de nuestros clientes.
      </p>
    </div>
  </section>

  <section class="py-5 text-center" id="Paquetes">
    <div class="row row-cols-1 row-cols-md-3 d-flex justify-content-center" id="paquetes-fila-1">
      <?php
      if ($result) {
        while ($paquete = mysqli_fetch_assoc($result)) {
          $id_lugar = $paquete['id_lugar'];
          $query = "SELECT img, nombre FROM lugar WHERE id_lugar = '$id_lugar'";
          $result2 = mysqli_fetch_assoc(mysqli_query($con, $query));
          $img = $result2['img'];
          $nombreLugar = $result2['nombre'];
          ?>
          <div class="col-3" style="width: 22rem">
            <div class="card mb-4 shadow">
              <img src="../imagenes/<?= $img ?>" class="bd-placeholder-img card-img-top" alt="Chirripo" width="100%"
                height="225" />
              <div class="card-body">
                <h5 class="card-title">
                  <?= $nombreLugar ?>
                </h5>
                <p class="card-text">
                  <?= $paquete['nombre'] ?>
                </p>
                <a href="../html/paquete.php?id=<?= $paquete['id_paquete'] ?>" class="btn">
                  $ <?= $paquete['precio'] ?>
                </a>
              </div>
            </div>
          </div>

          <?php
        }
      }
      ?>

    </div>
  </section>

  <section class="d-flex border-3 my-5 justify-content-center align-items-center" id="Contactanos">
    <div class="card text-center">
      <div class="card-body" style="max-width: 500px">
        <img src="../imagenes/support.png" alt="" class="img-fluid ps-5" />
        <h5 class="card-title mt-5">Contactanos</h5>
        <form method="POST" action="enviarMail.php">
          <div class="form-floating my-2">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo" />
            <label for="floatingInput">Correo Electronico</label>
          </div>

          <div class="form-floating my-2">
            <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" name="nombre" />
            <label for="floatingInput">Nombre</label>
          </div>

          <div class="mb-3">
            <textarea class="form-control" name="mensaje" id="message" rows="4"></textarea>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-success w-100 fs-5" name="enviar">
              Enviar Mensaje
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <footer class="d-flex align-items-center justify-content-center border-top p-3 flex-column"
    style="background-color: #1d9645">
    <p class="text-light mb-0 p-2 fs-6">
      <i class="ri-phone-fill m-2"></i><span>(506) 1010-0000</span>
      <i class="ri-mail-line m-2"></i><span>E@mail.com</span>
    </p>

    <div>
      <p class="text-light fs-5 px-3 pt-1">
        E-PuraVida. &copy; Todos Los Derechos Reservados 2023
      </p>
    </div>
  </footer>

  <script src="../js/bootstrap5.bundle.js"></script>
  <script src="../js/index1.js"></script>
</body>

</html>
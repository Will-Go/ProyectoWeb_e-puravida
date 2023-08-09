<?php
include("../../html/db.php");
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location:../../html/prohibido.html");
  exit();
} else if (isset($_POST['submit'])) {
  if (
    isset($_POST['idLugar'])
    && isset($_POST['fechaIni'])
    && isset($_POST['fechaFin'])
    && isset($_POST['idLugar'])
    && isset($_POST['descripcion'])
    && isset($_POST['nombre'])
    && isset($_POST['precio'])
  ) {

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $idLugar = $_POST['idLugar'];

    $query = "INSERT INTO paquete 
    VALUES(NULL, '$nombre', '$precio', '$descripcion', '$fechaIni', '$fechaFin','$idLugar')";

    mysqli_query($con, $query);
    echo "<script>alert('Se creo excitosamente ')</script> <script>window.location.href = 'crearPaquete.php';</script>";

  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crear Paquetes</title>
  <link rel="stylesheet" href="../../css/bootstrap5.min.css" />
  <link rel="stylesheet" href="../../css/remixicon.css" />
  <link rel="stylesheet" href="../../css/adminPaquete.css" />
  <link rel="icon" href="../../imagenes/LogoIco.ico" />
</head>

<body class="bg-secondary">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-1 shadow mb-3 rounded">
    <div class="container">
      <div>
        <p class="navbar-brand my-2 text-warning">
          ¡Bienvenido
          <?php

          echo $_SESSION['username']; ?>!
        </p>
      </div>
      <button class="navbar-toggler mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-warning" href="../admin/crearPaquete.php">Crear Paquete</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../admin/eliminarPaquete.php">Eliminar Paquete</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../admin/crearLugar.php">Agregar Lugar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../admin/eliminarLugar.php">Eliminar Lugar</a>
          <li class="nav-item">
            <form action="crearPaquete.php" method="POST">
              <a class="btn btn-outline-danger ms-3 fw-bold w-100" href="../../html/destroySession.php">Salir</a>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="container">
    <div id="formulario" class="card p-5 my-5 form-signin bg-light text-center">

      <i class="ri-dropbox-fill" style="font-size: 100px"></i>
      <h1 class="h3 mb-3 fw-normal">Crear Paquete</h1>


      <form method="POST" action="crearPaquete.php">
        <div class="input-group mb-2">
          <label class="input-group-text" for="inputLugar">Lugar</label>
          <select class="form-select" id="inputLugar" name="idLugar">
            <option selected>Eligue...</option>
            <?php
            if (isset($con)) {
              $query = "SELECT * FROM lugar";
              $result = mysqli_query($con, $query);
              if (mysqli_num_rows($result) > 0) {
                while ($images = mysqli_fetch_assoc($result)) { ?>
                  <option value="<?= $images['id_lugar'] ?>">
                    <?= $images['nombre'] ?>
                  </option>

                <?php }
              }
            }
            ?>

          </select>
        </div>

        <div class="form-floating my-2">
          <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" name="nombre" />
          <label for="floatingInput">Nombre</label>
        </div>

        <div class="form-floating my-2">
          <input type="number" class="form-control" id="floatingInput" placeholder="Precio" name="precio" />
          <label for="floatingInput">Precio</label>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Fecha Inicio</span>
          <input type="date" class="form-control" placeholder="fechaIni" aria-label="fechaIni" name="fechaIni"
            aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Fecha Expiracion</span>
          <input type="date" class="form-control" placeholder="fechaFin" aria-label="fechaFin" name="fechaFin"
            aria-describedby="basic-addon1">
        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label fs-5">Descripción</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion"></textarea>
        </div>
        <button class="w-100 btn btn-lg btn-warning" type="submit" name="submit">
          Crear Paquete
        </button>
      </form>
    </div>
  </section>
  <script src="../../js/bootstrap5.bundle.js"></script>
</body>

</html>
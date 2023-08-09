<?php
include("../../html/db.php");
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location:../../html/prohibido.html");
  exit();
} else {
  if (isset($_POST['submit'])) {
    if (
      isset($_FILES['img']) && isset($_POST['nombre'])
      && isset($_POST['ubicacion'])
      && isset($_POST['descripcion'])
    ) {
      $img_name = $_FILES['img']['name'];
      $tmp_name = $_FILES['img']['tmp_name'];
      $error = $_FILES['img']['error'];

      $nombre = $_POST['nombre'];
      $ubicacion = $_POST['ubicacion'];
      $descripcion = $_POST['descripcion'];

      if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex = strtolower($img_ex);
        $allowed_exs = array("jpg", "png", "jpeg");
        if (in_array($img_ex, $allowed_exs)) {
          $img_path = '../../imagenes/' . $img_name;
          move_uploaded_file($tmp_name, $img_path);

          //inserts
          $query = "INSERT INTO lugar VALUES(NULL, '$nombre', '$ubicacion', '$descripcion', '$img_name')";

          mysqli_query($con, $query);
          echo "<script>alert('Se creo excitosamente ')</script> <script>window.location.href = 'crearLugar.php';</script>";


        } else {
          echo "<script>alert('No se permite ese formato')</script>";

        }
      } else {
        echo "<script>alert('No se logro cargar el Archivo')</script>";
      }
    } else {
      echo "<script>alert('Valores Invalidos')</script>";

    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crear Lugar</title>
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
            <a class="nav-link " href="../admin/crearPaquete.php">Crear Paquete</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="../admin/eliminarPaquete.php">Eliminar Paquete</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" href="../admin/crearLugar.php">Agregar Lugar</a>
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

      <i class="ri-landscape-fill" style="font-size: 100px"></i>
      <h1 class="h3 mb-3 fw-normal">Crear Lugar</h1>


      <form method="POST" action="crearLugar.php" enctype="multipart/form-data">


        <div class="form-floating my-2">
          <input type="text" class="form-control" id="floatingInput" placeholder="Nombre" name="nombre" />
          <label for="floatingInput">Nombre</label>
        </div>

        <div class="form-floating my-2">
          <input type="text" class="form-control" id="floatingInput" placeholder="Ubicacion" name="ubicacion" />
          <label for="floatingInput">Ubicacion</label>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label fs-5">Ingrese una Imagen</label>

          <input class="form-control" type="file" id="img" name="img" />

        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label fs-5">Descripción</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion"></textarea>
        </div>
        <button class="w-100 btn btn-lg btn-warning" type="submit" name="submit">
          Crear Lugar
        </button>
      </form>
    </div>
  </section>
  <script src="../../js/bootstrap5.bundle.js"></script>
</body>

</html>
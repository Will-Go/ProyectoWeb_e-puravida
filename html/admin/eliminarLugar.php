<?php
include("../../html/db.php");
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location:../../html/prohibido.html");
  exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['boton'])) {
  $id = $_POST['boton'];
  // echo ($id);
  $query = "DELETE FROM lugar WHERE id_lugar = '$id'";
  $query2 = "SELECT * FROM paquete WHERE id_lugar = '$id'";
  $paquetes = mysqli_query($con, $query2);
  // $rowsPaquetes = mysqli_fetch_all($paquetes, MYSQLI_ASSOC);


  if (mysqli_num_rows($paquetes) > 0) {
    echo "<script>alert('Este lugar esta asociado a un paquete!!'); window.location.href='eliminarLugar.php';</script>";

  } else {
    if (mysqli_query($con, $query)) {
      // Deletion successful
      echo "<script>alert('Se a eliminado el Lugar con el id: $id'); window.location.href='eliminarLugar.php';</script>";

    } else {
      // Deletion failed
      echo "Error: " . mysqli_error($con);
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eliminar Lugar</title>
  <link rel="stylesheet" href="../../css/bootstrap5.min.css" />
  <link rel="stylesheet" href="../../css/remixicon.css" />
  <link rel="stylesheet" href="../../css/eliminarPaquete.css" />
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
            <a class="nav-link " href="../admin/crearLugar.php">Agregar Lugar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" href="../admin/eliminarLugar.php">Eliminar Lugar</a>
          <li class="nav-item">
            <form action="crearPaquete.php" method="POST">
              <a class="btn btn-outline-danger ms-3 fw-bold w-100" href="../../html/destroySession.php">Salir</a>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="m-3">
    <div id="formulario" class="card p-5 my-5 form-signin bg-light text-center">
      <div>
        <i class="ri-close-circle-line text-danger" style="font-size: 100px"></i>
        <i class="ri-landscape-fill" style="font-size: 100px"></i>
      </div>
      <h1 class="h3 mb-3 fw-normal">Eliminar Lugar</h1>


      <form method="POST" action="eliminarLugar.php">
        <div class="input-group mb-2">
          <table class="table align-middle">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Ubicacion</th>
                <th scope="col">Descripcion</th>
                <th scope="col">img</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php

              if (isset($con)) {
                $query = "SELECT * FROM lugar";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                  while ($lugar = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                      <td>
                        <?= $lugar['id_lugar'] ?>
                      </td>
                      <td>
                        <?= $lugar['nombre'] ?>
                      </td>
                      <td>
                        <?= $lugar['ubicación'] ?>
                      </td>
                      <td>
                        <p style="max-width: 100%;
                word-wrap: break-word;
                word-break: break-all;
                ">
                          <?= $lugar['descripcion'] ?>
                        </p>
                      </td>
                      <td>
                        <img src="../../imagenes/<?= $lugar['img'] ?>" style="width:100px">
                      </td>
                      <td>
                        <button class="w-100 btn btn-lg btn-outline-danger" type="submit" name="boton"
                          value="<?= $lugar['id_lugar'] ?>">
                          <i class="ri-delete-bin-line" style="width:100px"></i>
                        </button>
                      </td>
                    </tr>
                  <?php }
                }
              }
              ?>


            </tbody>
          </table>

        </div>
      </form>
    </div>
  </section>
  <script src="../../js/bootstrap5.bundle.js"></script>
</body>

</html>
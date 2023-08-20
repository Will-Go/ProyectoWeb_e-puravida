<?php
include("../../html/db.php");
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location:../../html/prohibido.html");
  exit();
} else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['boton'])) {
  $id = $_POST['boton'];

  $query = "DELETE FROM paquete WHERE id_paquete = '$id'";
  try {


    if (mysqli_query($con, $query)) {

      echo "<script>alert('Se a eliminado el paquete con el id: $id'); window.location.href='eliminarPaquete.php';</script>";

    } else {

      echo "Error: " . mysqli_error($con);
    }
  } catch (mysqli_sql_exception $e) {
    echo "<script>alert('Este Paquete $id ya tiene usuarios!!'); window.location.href='eliminarPaquete.php';</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eliminar Paquete</title>
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
            <a class="nav-link text-warning" href="../admin/eliminarPaquete.php">Eliminar Paquete</a>
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

  <section class="m-3">
    <div id="formulario" class="card p-5 my-5 form-signin bg-light text-center">
      <div>

        <i class="ri-close-circle-line text-danger" style="font-size: 100px"></i>
        <i class="ri-dropbox-fill" style="font-size: 100px"></i>
      </div>
      <h1 class=" h3 mb-3 fw-normal">Eliminar Paquete</h1>


      <form method="POST" action="eliminarPaquete.php">
        <div class="input-group mb-2">
          <table class="table align-middle">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha limite de inscripcion</th>
                <th scope="col">img</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($con)) {
                $query1 = "SELECT * FROM paquete";
                $query2 = "SELECT * FROM lugar";
                $paquetes = mysqli_query($con, $query1);
                $lugares = mysqli_query($con, $query2);
                $rowsLugares = mysqli_fetch_all($lugares, MYSQLI_ASSOC);
                if (mysqli_num_rows($paquetes) > 0) {

                  while ($paquete = mysqli_fetch_assoc($paquetes)) {
                    $idLugar = $paquete['id_lugar'];
                    $img = null;
                    foreach ($rowsLugares as $element) {
                      if ($element['id_lugar'] == $idLugar) {
                        $img = $element['img'];
                        break;
                      }
                    }
                    ?>
                    <tr>
                      <td>
                        <?= $paquete['id_paquete'] ?>
                      </td>
                      <td>
                        <?= $paquete['nombre'] ?>
                      </td>
                      <td>
                        <?= $paquete['precio'] ?>
                      </td>
                      <td>
                        <p style="max-width: 100%;
                word-wrap: break-word;
                word-break: break-all;
                ">
                          <?= $paquete['descripcion'] ?>
                        </p>
                      </td>
                      <td>
                        <?= $paquete['fecha_inicio'] ?>
                      </td>
                      <td>
                        <?= $paquete['fecha_limite'] ?>
                      </td>
                      <td>
                        <img src="../../imagenes/<?= $img ?>" style="width:100px">

                      </td>
                      <td>
                        <button class="w-100 btn btn-lg btn-outline-danger" type="submit" name="boton" data-bs-toggle="modal"
                          data-bs-target="#<?= $paquete['id_paquete'] ?>" value="<?= $paquete['id_paquete'] ?>">
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
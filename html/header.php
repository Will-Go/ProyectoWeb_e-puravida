<?php

include("db.php");
include("userSession.php");
//$cliente es el objeto con los datos del usuario

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />

  <!-- Bootstrap core CSS -->
  <link href="../css//bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/remixicon.css" />
  <!-- <link rel="stylesheet" href="../css/main.css" /> -->



</head>

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
        <li class="nav-item ">
          <a class="nav-link " href="../html/mapa.php">Lugares</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/paquetes.php">Paquetes</a>
        </li>

        <?php
        if (isset($cliente)) { ?>
          <li class="nav-item dropdown">
            <button class="ri-account-circle-fill fs-1 mx-4 btn dropdown-toggle" role="button" id="dropdownMenuLink"
              data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu w-75" aria-labelledby="dropdownMenuLink">
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
<script src="../js/bootstrap5.bundle.js"></script>

</html>
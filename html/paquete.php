<?php
include("db.php");

if (isset($_GET['id'])) {
  $id_paquete = $_GET['id'];
  $query1 = "SELECT * FROM paquete WHERE id_paquete = '$id_paquete'";
  $paquetes = mysqli_query($con, $query1);
  $query2 = "SELECT * FROM lugar";
  $lugares = mysqli_query($con, $query2);
  $rowsLugares = mysqli_fetch_all($lugares, MYSQLI_ASSOC);


  if (mysqli_num_rows($paquetes) > 0) {
    //EXTRAE TODA LA INFORMACION DEL PAQUE
    $row = mysqli_fetch_assoc($paquetes);
    $paqueteId = $row['id_paquete'];
    $paqueteName = $row['nombre'];
    $paqueteDescription = $row['descripcion'];
    $paquetePrecio = $row['precio'];
    $paqueteFechaIni = $row['fecha_inicio'];
    $paqueteFechaFin = $row['fecha_limite'];
    $idLugar = $row['id_lugar'];
    $img = null;
    foreach ($rowsLugares as $element) {
      if ($element['id_lugar'] == $idLugar) {
        $img = $element['img'];
        break;
      }
    }
  }
  //EXTRAER TODAS LAS RESEÑAS DEL PAQUETE
  $query3 = "SELECT r.estrellas, r.comentario, r.fecha, c.nombre  FROM reseña r  JOIN cliente c ON r.id_cliente = c.correo WHERE id_paquete = '$id_paquete'";
  $reseñas = mysqli_query($con, $query3);


  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php

    if (mysqli_num_rows($paquetes) > 0) {

      ?>

      <title>
        <?= $row['nombre'] ?>
      </title>
    <?php } else { ?>

      <title>No existe!!</title>
      <?php
    }
    ?>
    <link rel="stylesheet" href="../css/bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/remixicon.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/paquete.css" />
    <link rel="icon" href="../imagenes/LogoInvertido.ico" />


  </head>

  <body>
    <?php
    include("header.php");
    ?>
    <?php

    if (mysqli_num_rows($paquetes) > 0) {
      // Mostrar la info
      ?>
      <!-- MOSTRAR TODA LA INFO HTML-->
      <div class="container">
        <div class="py-5 text-center">

          <h2>Paquete</h2>
        </div>
        <div class="row g-5">

          <!-- FACTURA -->
          <div class="col-md-4 col-lg-5 order-md-last sticky-top">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
            </h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0">Fecha expiración</h6>
                  <small class="text-muted">
                    <?= $paqueteFechaFin ?>
                  </small>
                </div>
                <div>

                  <h6 class="my-0">Fecha Comienzo</h6>
                  <small class="text-muted">
                    <?= $paqueteFechaIni ?>
                  </small>
                </div>
              </li>

              <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>$
                  <?= $paquetePrecio ?>
                </strong>
              </li>
            </ul>

            <form class="card p-2">
              <?php
              if (isset($cliente)) { ?>
                <a type="submit" class="btn btn-outline-success" href="../html/checkout.php?id=<?= $paqueteId ?>">Ir a
                  Pagar</a>
                <?php
              } else {

                ?>
                <a type="submit" class="btn btn-outline-success" href="../html/login.php">Ir a
                  Pagar</a>
                <?php
              }
              ?>

            </form>

          </div>
          <!-- FACTURA -->

          <!-- INFORMACION DEL PAQUETE -->

          <div class="col-md-7 col-lg-7 border p-4 rounded">
            <h4 class="mb-3">
              <?= $paqueteName ?>
            </h4>
            <div class="row g-3">
              <div class="col-sm-12 d-flex justify-content-center">
                <img class="img-fluid" src="../imagenes/<?= $img ?>" style="object-fit:contain;">
              </div>

              <div class="col-12">
                <p class="form-label fw-bold">Descripcion</p>
                <p class="text-break lh-base">
                  <?= $paqueteDescription ?>
                </p>
              </div>


            </div>
          </div>

          <!-- INFORMACION DEL PAQUETE -->

        </div>
      </div>

      <!-- MOSTRAR TODA LA INFO HTML-->
      <hr class="mt-5">
      <!-- RESEÑAS -->

      <div class="container">

        <?php if (isset($cliente)) { ?>
          <form action="enviarReseña.php" method="POST">
            <div class="container">


              <div id="reseñas" class="bg-success">

                <?php for ($i = 5; $i >= 1; $i--) { ?>

                  <input class="col" type="radio" name="rate" id="rate-<?= $i ?>" value="<?= $i ?>" required>
                  <label for="rate-<?= $i ?>" class="ri-star-fill"></label>

                <?php } ?>
              </div>
              <div class="input-group mb-3">
                <span class="ri-account-circle-fill fs-1 input-group-text"></span>
                <textarea class="form-control" name="comentario" placeholder="Añade una reseña" rows="3" required></textarea>
              </div>

              <button class="btn btn-outline-success" name="enviarReseña" value="<?= $id_paquete ?>">Enviar</button>
            </div>
          </form>
        <?php } else { ?>
          <div class="border p-2 rounded">

            <p class="fw-bold">Para Crear una reseña, tienes que tener una cuenta</p>
            <a class="btn btn-outline-success fs-6" href="login.php">Iniciar Sesion</a>
          </div>
        <?php } ?>
        <hr class="my-4">
        <h1 class="mb-3">Reseñas: </h1>
        <!-- SACAR TODOS LOS COMENTARIOS DE ESTE PAQUETE -->

        <?php
        if (mysqli_num_rows($reseñas) > 0) {
          while ($reseña = mysqli_fetch_assoc($reseñas)) {
            $puntaje = $reseña['estrellas'];
            $comentario = $reseña['comentario'];
            $usuario = $reseña['nombre'];
            $fecha = $reseña['fecha'];
            ?>

            <div class="card my-3" style="width: 100%">
              <div class="card-header">
                <i class="ri-account-circle-fill fs-2 fw-bold"></i>
                <span class="fw-bold">
                  <?= $usuario ?>
                </span>
              </div>

              <ul class="list-group list-group-flush">

                <li class="list-group-item d-flex justify-content-center">

                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <?php if ($i <= $puntaje) { ?>
                      <label for="rate-<?= $i ?>" class="ri-star-fill text-success"></label>

                    <?php } else { ?>
                      <label for="rate-<?= $i ?>" class="ri-star-line text-success"></label>
                    <?php } ?>
                  <?php } ?>

                </li>
                <li class="list-group-item">

                  <?= $comentario ?>
                </li>
              </ul>


              <div class="card-footer text-muted">
                -
                <?= $fecha ?>
              </div>


            </div>
          <?php }
        } else {
          ?>
          <div class="d-flex justify-content-center text-muted fst-italic ">No hay reseñas</div>
        <?php } ?>
        <hr class="my-4">
      </div>
      <!-- RESEÑAS -->
      <footer class="mt-5">
        <?php include("footer.html") ?>
      </footer>

      <?php

    } else {
      echo "<script>alert('No existe el Paquete!! ')</script> <script>window.location.href = 'paquetes.php';</script>";
    }
    ?>

  </body>

  </html>

  <?php
} else {
  header("Location:paquetes.php");
}

?>
<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <link rel="icon" href="../imagenes/LogoInvertido.ico" />
  <title>Paquetes</title>

  <!-- Bootstrap core CSS -->
  <!-- <link href="../css//bootstrap.rtl.min.css" rel="stylesheet" /> -->
  <link href="../css//bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/remixicon.css" />
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    img {
      object-fit: contain;
      max-width: 100%;
      max-height: 100%;

    }
  </style>
</head>

<body>
  <header>
    <?php include("header.php"); ?>
  </header>
  <main>
    <section class="py-1 text-center container">
      <div class="row py-lg-1">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Bienvenido</h1>
          <p class="lead text-muted">
            Aca puede encontrar la informacion de distintos paquetes
          </p>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">




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

                $query = "SELECT img, nombre FROM lugar WHERE id_lugar = '$idLugar'";
                $result2 = mysqli_fetch_assoc(mysqli_query($con, $query));
                $img = $result2['img'];
                $nombreLugar = $result2['nombre'];

                ?>
                <div class="col">
                  <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg"
                      role="img" aria-label="Placeholder: صورة مصغرة" preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>
                        <?= $paquete['nombre'] ?>
                      </title>
                      <rect width="100%" height="100%" />
                      <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                        <?= $nombreLugar ?>
                      </text>
                      <image opacity="45%" xlink:href="../imagenes/<?= $img ?>"></image>
                    </svg>

                    <div class="card-body">
                      <p class="card-text">
                        <?= $paquete['nombre'] ?>
                      </p>
                      <div class="d-flex justify-content-between align-items-center">


                        <a class="btn btn-sm btn-outline-success" href="../html/paquete.php?id=<?= $paquete['id_paquete'] ?>">
                          Reservar
                        </a>

                        <small class="text-muted"> :
                          $
                          <?= $paquete['precio'] ?>
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </main>
  <?php include("footer.html"); ?>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
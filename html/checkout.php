<?php
include("db.php");

if (isset($_GET['id'])) {
  $id_paquete = $_GET['id'];
  $query1 = "SELECT * FROM paquete WHERE id_paquete = '$id_paquete'";
  $paquetes = mysqli_query($con, $query1);
  $query2 = "SELECT * FROM lugar";
  $lugares = mysqli_query($con, $query2);
  $rowsLugares = mysqli_fetch_all($lugares, MYSQLI_ASSOC);

  //SACA TODA LA INFO DEL PAQUETE CON EL ID
  if (mysqli_num_rows($paquetes) > 0) {

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
  } ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />

    <!-- PARA PONER EL NOMBRE DEL PAQUETE -->
    <?php

    if (mysqli_num_rows($paquetes) > 0) {

      ?>

      <title>
        <?= $paqueteName ?>
      </title>
    <?php } else { ?>

      <title>No existe!!</title>
      <?php
    }
    ?>
    <!-- PARA PONER EL NOMBRE DEL PAQUETE -->


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/remixicon.css" />
    <link rel="icon" href="../imagenes/LogoInvertido.ico" />



    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet" />
  </head>

  <body class="bg-light">
    <?php include("header.php"); ?>
    <div class="container">
      <main>
        <div class="py-5 text-center">

          <h2>Detalle de Pago</h2>
          <hr class="my-4" />
        </div>
        <?php

        if (mysqli_num_rows($paquetes) > 0) {
          // Mostrar la info
          ?>
          <form class="needs-validation" method="POST" action="compra.php?id=<?= $paqueteId ?>">
            <div class="row g-5">


              <!-- FACTURA -->
              <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-success">Tu Compra</span>
                </h4>
                <ul class="list-group mb-3">

                  <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                      <h6 class="my-0">
                        <?= $paqueteName ?>
                      </h6>

                    </div>
                  </li>

                  <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>
                      <?= $paquetePrecio ?>
                    </strong>
                  </li>
                </ul>

                <div class="card p-2">
                  <button type="submit" name="pagar" class="btn btn-outline-success ">Pagar</button>
                </div>

              </div>
              <!-- FACTURA -->

              <!-- INFORMACION DEL USUARIO -->

              <div class="col-md-7 col-lg-8">
                <h4 class="mb-3"></h4>
                <div class="row g-3">

                  <div class="col-6 my-1 border-end border-start">
                    <i class="ri-account-circle-fill fs-1 m-2 "></i>
                    <span>
                      <?= $cliente['nombre'] ?>
                    </span>
                  </div>
                  <div class="col-6 my-1 border-end ">
                    <i class="ri-mail-fill fs-1 m-2"></i>
                    <span>
                      <?= $cliente['correo'] ?>
                    </span>
                  </div>
                  <hr class="my-4" />

                  <!-- METODO DE PAGO -->

                  <h4 class="mb-3">Metodo de Pago</h4>

                  <div class="my-3">
                    <div class="form-check">
                      <input id="credit" name="mPago" type="radio" value="creditcard" class="form-check-input" required />
                      <label class="form-check-label" for="credit">Creditcard</label>
                    </div>
                    <div class="form-check">
                      <input id="debit" name="mPago" type="radio" value="debitcard" class="form-check-input" required />
                      <label class="form-check-label" for="debit">Debitcard</label>
                    </div>
                  </div>

                  <div class="row gy-3">
                    <div class="col-md-12">
                      <label for="cc-number" class="form-label">Numero de la Tarjeta</label>
                      <input type="text" name="numTarjeta" class="form-control" pattern="\d{16}" required
                        title="Tienes que digitar un numero de 16 digitos" />
                      <div class="invalid-feedback">
                        Credit card number is required
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="año" class="form-label">Año de expiración</label>
                      <input type="number" name="año" class="form-control" id="year" min="2023" max="2100" step="1"
                        required>
                      <div class="invalid-feedback">Necesario</div>
                    </div>
                    <div class="col-md-4">
                      <label for="mes" class="form-label">Mes de expiración</label>
                      <select name="mes" class="form-control" required>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                          echo "<option value='$i'>$i</option>";
                        }
                        ?>
                      </select>
                      <div class="invalid-feedback">Necesario</div>
                    </div>
                    <div class="col-4"></div>

                    <div class="col-md-3">
                      <label for="cc-cvv" class="form-label">CVC</label>
                      <input type="text" class="form-control" name="cvc" placeholder="" required />
                      <div class="invalid-feedback">Security code required</div>
                    </div>
                  </div>

                  <!-- METODO DE PAGO -->

                </div>
          </form>

          <!-- INFORMACION DEL USUARIO -->
      </div>
      </main>
      </div>

      <footer class="mt-5 text-muted text-center text-small">
        <?php include("footer.html"); ?>
      </footer>

      <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>

      <?php

        } else {
          echo "No existe el paquete!";
        }
}
?>
</body>

</html>
<?php
try {


  include("../../html/db.php");
  ;
  if (isset($_POST['correo']) && isset($_POST['contra'])) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $email = $_POST['correo'];
      $password = $_POST['contra'];

      $query = "SELECT * FROM administrador WHERE correo = '$email' and contraseña = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $count = mysqli_num_rows($result);
      if ($count == 1) {
        $query = "SELECT * FROM administrador WHERE correo = '$email'";
        $result = mysqli_query($con, $query);
        if ($result) {

          $row = mysqli_fetch_assoc($result);

          $name = $row['nombre'];
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $name;
          echo "<script>
        alert('Inicio de Sesion Exitosa!');
        </script>";
          header("Location: crearPaquete.php");

          exit();

        } else {
          $error_message = mysqli_error($con);
          echo "<script>
        alert('$error_message');
        </script>";
        }



      } else {

        header("Location: admin.php?error=Credenciales incorrectos!");

      }
    }
  }
} catch (Exception $e) {

  echo "'$e'";
  header("Location:  admin.php?error=Credenciales incorrectos!");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="../../css/bootstrap5.min.css" />
  <link rel="stylesheet" href="../../css/remixicon.css" />
  <link rel="icon" href="../../imagenes/LogoInvertido.ico" />
  <link rel="stylesheet" href="../../css/login.css" />

</head>

<body class=" bg-secondary">
  <nav class="navbar  navbar-dark bg-dark p-1 shadow mb-3 rounded">
    <div class="container-fluid d-flex row text-center justify-content-center">
      <p class="navbar-brand fs-1 text-light">ADMIN</p>
      <p class="navbar-brand fs-3 text-warning">
        ¡¡SOLOR PERSONAL AUTORIZADO!!
      </p>
    </div>
  </nav>
  <section>
    <div id="formulario" class="card p-5 my-5 form-signin bg-light text-center">
      <i class="ri-account-circle-fill" style="font-size: 100px"></i>

      <h1 class="h3 mb-3 fw-normal">A TRABAJAR!!</h1>
      <?php if (isset($_GET['error'])) { ?>
        <div class='alert alert-danger' role='alert'>
          <i class='ri-error-warning-line fs-5'></i>
          <?php echo $_GET['error']; ?>
        </div>
      <?php } ?>
      <form action="admin.php" method="POST">

        <div class="form-floating my-2">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="correo" />
          <label for="floatingInput">Correo Electronico</label>
        </div>
        <div id="password" class="form-floating my-2">
          <i id="ojo" class="ri-eye-off-fill"></i>
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contra" />
          <label for="floatingPassword">Contraseña </label>
        </div>

        <button class="w-100 btn btn-lg btn-warning" type="submit">
          Iniciar
        </button>
      </form>
      <a class="w-100 btn btn-outline-danger btn-lg my-2" href="../../html/index.php">
        Volver
      </a>
    </div>
  </section>
  <script src="../../js/login.js"></script>

</body>

</html>
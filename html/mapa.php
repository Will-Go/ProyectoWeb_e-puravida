<?php
include("mapaSelector.php");

$guana = eleguirLugar('Guanacaste');
$alajuela = eleguirLugar('Alajuela');
$punta = eleguirLugar('Puntarenas');
$limon = eleguirLugar('Limón');
$cartago = eleguirLugar('Cartago');
$sanjose = eleguirLugar('San José');

?>

<!DOCTYPE html>
<html>

<head>
  <title>Mapa Costa Rica</title>
  <style>
    .button-overlay {
      position: absolute;
      background-color: transparent;
      border: none;
      cursor: pointer;
      width: 50px;
      height: 50px;
    }
  </style>
  <link href="../css//bootstrap5.min.css" rel="stylesheet" />
  <link rel="icon" href="../imagenes/LogoInvertido.ico" />

</head>

<body style="background-color: #78c0e0 ;">
  <header>
    <?php include("header.php"); ?>
  </header>
  <div style="position: relative" class="d-flex justify-item-center m-auto">
    <img src="../imagenes/Costa Rica.png" alt="Mapa" />
    <!-- Monteverte -->
    <button id="boton1" class="button-overlay" style="top: 200px; left: 400px"
      onclick="irASitio('../html/paquete.php?id=<?= $punta ?>')"></button>
    <!-- Manuel antonio -->
    <button id="boton2" class="button-overlay" style="top: 326px; left: 520px"
      onclick="irASitio('../html/paquete.php?id=<?= $punta ?>')"></button>
    <!-- Playa Hermosa -->
    <button id="boton3" class="button-overlay" style="top: 300px; left: 465px"
      onclick="irASitio('../html/paquete.php?id=<?= $punta ?>')"></button>
    <!-- Museo Nacional -->
    <button id="boton4" class="button-overlay" style="top: 286px; left: 548px"
      onclick="irASitio('../html/paquete.php?id=<?= $sanjose ?>')"></button>
    <!-- La fortuna -->
    <button id="boton5" class="button-overlay" style="top: 170px; left: 444px"
      onclick="irASitio('../html/paquete.php?id=<?= $alajuela ?>')"></button>
    <!-- Poas -->
    <button id="boton6" class="button-overlay" style="top: 217px; left: 500px"
      onclick="irASitio('../html/paquete.php?id=<?= $alajuela ?>')"></button>
    <!-- Turrialba -->
    <button id="boton7" class="button-overlay" style="top: 237px; left: 602px"
      onclick="irASitio('../html/paquete.php?id=<?= $cartago ?>')"></button>
    <!-- Cahuita -->
    <button id="boton8" class="button-overlay" style="top: 214px; left: 719px"
      onclick="irASitio('../html/paquete.php?id=<?= $limon ?>')"></button>
    <!-- Tamarindo -->
    <button id="boton9" class="button-overlay" style="top: 189px; left: 212px"
      onclick="irASitio('../html/paquete.php?id=<?= $guana ?>')"></button>
  </div>

  <script>
    function irASitio(url) {
      window.location.href = url;
    }
  </script>
  <footer>
    <?php include("footer.html"); ?>
  </footer>
</body>

</html>
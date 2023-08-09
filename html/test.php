<?php
include("db.php");
//$cliente es el objeto con los datos del usuario
include("userSession.php");

$query = "SELECT COUNT(*) AS total_paquetes FROM paquete";
$result = mysqli_fetch_assoc(mysqli_query($con, $query));
$total_paquetes = $result['total_paquetes'];

//GENERA 3 NUMEROS RANDOMS Y LOS GUARDA EN $numeros

$numeros = array();
for ($i = 1; $i <= 3; $i++) {
    do {
        $randomNumber = rand(1, $total_paquetes);
    } while (in_array($randomNumber, $numeros));

    $numeros[] = $randomNumber;
}
$a = $numeros[0];
$b = $numeros[1];
$c = $numeros[2];
$query2 = "SELECT * FROM paquete WHERE id_paquete IN ('$a','$b','$c')";
$result = mysqli_query($con, $query2);


?>

<?php
if ($result) {
    while ($paquete = mysqli_fetch_assoc($result)) {
        $id_lugar = $paquete['id_lugar'];
        $query = "SELECT img, nombre FROM lugar WHERE id_lugar = '$id_lugar'";
        $result2 = mysqli_fetch_assoc(mysqli_query($con, $query));
        $img = $result2['img'];
        $nombreLugar = $result2['nombre'];
        ?>
        <div class="col-3" style="width: 22rem">
            <div class="card mb-4 shadow">
                <img src="../imagenes/<?= $img ?>" class="bd-placeholder-img card-img-top" alt="Chirripo" width="100%"
                    height="225" />
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $nombreLugar ?>
                    </h5>
                    <p class="card-text">
                        <?= $paquete['nombre'] ?>
                    </p>
                    <a href="../html/paquete.php?id=<?= $paquete['id_paquete'] ?>" class="btn">
                        $ <?= $paquete['precio'] ?>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }
}
?>
<?php
include("db.php");
include("userSession.php");



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pagar'])) {
    if (isset($_GET['id'])) {
        $paqueteId = $_GET['id'];
        $query = "SELECT * FROM paquete WHERE id_paquete = '$paqueteId'";
        $paquetes = mysqli_query($con, $query);
        if (mysqli_num_rows($paquetes) > 0) {

            $row = mysqli_fetch_assoc($paquetes);
            $paquetePrecio = $row['precio'];
        }

        if (isset($cliente)) {

            $numTarjeta = $_POST['numTarjeta'];
            $metodo = $_POST['mPago'];


            //formateo de la fecha de expiracion
            $expAño = $_POST['año'];
            $expMes = $_POST['mes'];
            $dateString = $expAño . "-" . $expMes . "-01";
            $dateTimeObj = new DateTime($dateString);
            //fecha de expiracion completa
            $fechaExp = $dateTimeObj->format('Y-m-d');

            $cvc = $_POST['cvc'];

            $userCorreo = $cliente['correo'];
            $query1 = "SELECT num_tarjeta FROM metodo_pago WHERE num_tarjeta = '$numTarjeta'";
            $result = mysqli_query($con, $query1);
            if (mysqli_num_rows($result) == 0) {
                $query1 = "INSERT INTO metodo_pago VALUES ('$numTarjeta', '$metodo', '$fechaExp', '$cvc','$userCorreo')";
                $result = mysqli_query($con, $query1);
            }


            if ($result) {
                date_default_timezone_set('GMT');
                $fechaCompra = date('Y-m-d H:i:s');

                $query2 = "INSERT INTO detalle_paquete VALUES (NULL, '$paquetePrecio', '$fechaCompra', '$userCorreo','$numTarjeta', '$paqueteId')";

                if (mysqli_query($con, $query2)) {

                    echo "<script>alert('Muchas Gracias Por la Compra'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Algo no funciono'); window.location.href='index.php';</script>";

                }

            } else {

                echo "<script>alert('Algo no funciono'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('NO'); window.location.href='index.php';</script>";
        }

    } else {
        echo "<script>alert('NO'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('NO'); window.location.href='index.php';</script>";
}

?>
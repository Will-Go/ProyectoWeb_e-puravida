<?php
include("db.php");
include("userSession.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviarReseña'])) {
    if (isset($cliente)) {
        $id_paquete = $_POST['enviarReseña'];
        $puntaje = $_POST['rate'];
        $comentario = $_POST['comentario'];
        $correo = $cliente['correo'];
        $fechaHoy = date('Y-m-d H:i:s');
        echo ($puntaje . "<br>");
        echo ($comentario . "<br>");
        echo ($correo . "<br>");
        $query = "INSERT INTO reseña VALUES(null,'$puntaje','$comentario','$fechaHoy','$correo', '$id_paquete')";
        $result = mysqli_query($con, $query);
        header("Location: paquete.php?id=$id_paquete");
    }
}
?>